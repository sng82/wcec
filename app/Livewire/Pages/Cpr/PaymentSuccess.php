<?php

namespace App\Livewire\Pages\Cpr;

use App\Mail\CPRFeePaidAdminNotification;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Stripe\StripeClient;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PaymentSuccess extends Component
{
    use LivewireAlert;
    public $stripe_session_id;
    public $customer;

    public function mount(Request $request)
    {
        try {
            $this->stripe_session_id = $request->get('session_id');

            $order = Order::where('stripe_session_id', $this->stripe_session_id)
                          ->first();

            if (!$order) {
                throw new NotFoundHttpException();
            }

            if ($order->order_status === 'unpaid') {
                $order->order_status = 'paid';
                $order->save();

                $user = User::findorFail($order->user_id);
                if ($order->product_name === 'registration') {
                    $user->registration_fee_paid = true;
                }
                if ($order->product_name === 'application') {
                    $user->application_fee_paid = true;
                }
                $user->save();

//                 @todo: Send email to user & admins confirming purchase
                $admins = User::role('admin')->get();
                foreach ($admins as $admin) {
                    Mail::to($admin->email)
                        ->send(new CPRFeePaidAdminNotification($order));
                }
            }

            return $this->flash(
                'success',
                'Payment Successful.',
                [
                    'position' => 'top-end',
                    'timer' => 2000,
                    'showConfirmButton' => false,
                    'confirmButtonColor' => '#10b981',
                ],
                'cpr/dashboard'
            );

        } catch (\Exception $e) {
            error_log('Payment Error: ' . $e->getMessage());

            return $this->flash(
                'error',
                'There may have been a problem processing your payment. Please contact us.',
                [
                    'position' => 'center',
                    'timer' => null,
                    'showConfirmButton' => true,
                    'confirmButtonColor' => '#dc2626',
                ],
                'cpr/dashboard'
            );
        }



    }
}
