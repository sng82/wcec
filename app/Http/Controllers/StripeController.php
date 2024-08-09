<?php

namespace App\Http\Controllers;

use App\Mail\CPRFeePaidAdminNotification;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use League\Flysystem\Config;
use Stripe\Exception\SignatureVerificationException;
use Stripe\StripeClient;
use Stripe\Webhook;

class StripeController extends Controller
{
    public function webhook()
    {
        $stripe             = new StripeClient(config('stripe.secret'));
        $endpoint_secret    = config('stripe.webhook.secret');
        $payload            = @file_get_contents('php://input');
        $sig_header         = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event              = null;

        Log::error('Testing 12345');

        try {
            $event = Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            Log::error('Stripe Invalid Payload: ' . $e->getMessage());
            http_response_code(400);
            exit();
            // return response('', 400);
        } catch (SignatureVerificationException $e) {
            // Invalid signature
            Log::error('Stripe Invalid signature: ' . $e->getMessage());
            http_response_code(400);
            exit();
            // return response('', 400);
        }

        Log::error($event->type ?: 'No Event Type');

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

//            case 'invoice.payment_succeeded':

            default:
                Log::error('Stripe webhook unknown event: ' . $event->type);
                echo 'Received unknown event type ' . $event->type;
        }

//        Log::error('Testing 123');

        http_response_code(200);
//        return response('', 200);
    }
}
