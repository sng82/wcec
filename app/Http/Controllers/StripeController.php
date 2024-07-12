<?php

namespace App\Http\Controllers;

use App\Mail\CPRFeePaidAdminNotification;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use League\Flysystem\Config;
use Stripe\Exception\SignatureVerificationException;
use Stripe\StripeClient;
use Stripe\Webhook;

class StripeController extends Controller
{
    public function webhook()
    {
        $stripe             = new StripeClient(Config('stripe.secret'));
        $endpoint_secret    = Config('stripe.webhook.secret');
        $payload            = @file_get_contents('php://input');
        $sig_header         = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event              = null;

        try {
            $event = Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
            // return response('', 400);
        } catch (SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            exit();
            // return response('', 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':

                $paymentIntent = $event->data->object;

                $order = Order::where('stripe_session_id', $paymentIntent->id)
                              ->first();

                if ($order && $order->order_status === 'unpaid') {
                    $order->order_status = 'paid';
                    $order->save();

                    $user = User::findorFail($order->user_id);
                    if ($order->product_name === 'registration') {
                        $user->registration_fee_paid = true;
                    }
                    if ($order->product_name === 'submission') {
                        $user->submission_fee_paid = true;
                    }
                    $user->save();

                    // @todo: Send email to user & admins confirming purchase

                    $admins = User::role('admin')->get();
                    foreach ($admins as $admin) {
                        Mail::to($admin->email)
                            ->send(new CPRFeePaidAdminNotification($order));
                    }
                }

//            case 'payment_intent.succeeded':
//                $paymentIntent = $event->data->object;
            // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }


        http_response_code(200);
//        return response('', 200);
    }
}
