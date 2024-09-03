<?php

namespace App\Http\Controllers;

use App\Mail\CPRFeePaidAdminNotification;
use App\Mail\CPRFeePaidUserNotification;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
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

//        Log::error('Testing 12345');

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

        // Useful for debugging:
//        Log::info($event->type ?: 'No Event Type');

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':

                $paymentIntent = $event->data->object;

                $order = Order::where('stripe_session_id', $paymentIntent->id)
                              ->first();

                if ($order && $order->order_status === 'unpaid') {
                    $order->order_status = 'paid';
                    $order->payment_intent = $paymentIntent->payment_intent;
                    $order->save();

                    $user = User::findorFail($order->user_id);
                    if ($order->product_name === 'registration') {
                        $user->registration_fee_paid = true;
                    }
                    if ($order->product_name === 'submission') {
                        $user->submission_fee_paid = true;
                    }
                    if ($order->product_name === 'renewal') {
                        $user->renewal_fee_last_paid_at = Carbon::now();
                    }
                    $user->save();

                    Mail::to(config('mail.membership_enquiry_mail_recipient'))
                        ->send(new CPRFeePaidAdminNotification($order, $user));

                    Mail::to($user->email)
                        ->send(new CPRFeePaidUserNotification($order, $user));

                    // TODO: Investigate fetching receipt pdf (if one exists?) using the API, and storing it locally.
                }
                break;

            // @NOTE: This case won't be reached unless invoice creation is
            // enabled in PayFee() method @ app\Livewire\Pages\Cpr\Dashboard.php
            // See the comment(s) there.
            // If enabled, Stripe *SHOULD* automatically send an invoice to the user when system is live,
            // if that doesn't happen, manual sending can be triggered from here.
            case 'invoice.payment_succeeded':
                $stripeData = $event->data->object;
                $order = Order::where('payment_intent', $stripeData->payment_intent)
                              ->first();
                if ($order) {
                    $order->stripe_hosted_invoice_url = $stripeData->hosted_invoice_url;
                    $order->save();
                }
                // TODO: Investigate fetching invoice pdf using the API, and storing it locally.
                break;

            default:
                // Useful for debugging:
//                Log::info('Stripe webhook unknown event: ' . $event->type);
        }

        http_response_code(200);
//        return response('', 200);
    }
}
