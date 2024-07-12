<?php

namespace App\Livewire\Pages\Cpr;

use App\Models\Order;
use App\Models\Prices;
use App\Models\SubmissionDate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Log;
use Stripe\StripeClient;

class Dashboard extends Component
{
    use LivewireAlert;

    public $title = "CPR Dashboard";
    public $next_admission_date = '';
    public $next_admission_date_difference = '';

    public $submitted_eois = '';

    public $submitted_submissions = '';

    public $expiring_registrations = '';

    public $logged_in_user;

    public $submission_fee;
    public $registration_fee;

    public function mount()
    {
        $this->getSubmissionDate();
        $this->getEOIs();
        $this->getSubmissions();
        $this->getExpiringRegistrations();
        $this->getSubmissionFee();
        $this->getRegistrationFee();
    }

    public function openMember($id)
    {
        $this->redirect('member-edit/' . $id);
    }

    public function getEOIs()
    {
        $this->submitted_eois = User::role('applicant')
                                    ->where('registration_fee_paid', true)
                                    ->where('eoi_status', 'submitted')
                                    ->where(function($query) {
                                        $query->where('submission_status', null)
                                              ->orWhere('submission_status', '');
                                    })
                                    ->get();
    }

    public function getSubmissions()
    {
        $this->submitted_submissions = User::role('applicant')
                                            ->where('registration_fee_paid', true)
                                            ->where('eoi_status', 'accepted')
                                            ->where('submission_fee_paid', true)
                                            ->where('submission_status', 'submitted')
                                            ->get();
    }

    public function getExpiringRegistrations()
    {
        $this->expiring_registrations = User::role('registrant')
                                          ->where('registration_expires_at', '>', now())
                                          ->where('registration_expires_at', '<', now()->addDays(30))
                                          ->orderBy('registration_expires_at', 'ASC')
                                          ->get();
    }

    public function getRegistrationFee()
    {
        $this->registration_fee = Prices::where('price_type', 'registration')
                                        ->where('start_date', '<=', now())
                                        ->where(function($query) {
                                            $query->where('end_date', '>', now())
                                                  ->orWhere('end_date', null);
                                        })
                                        ->orderBy('start_date')
                                        ->first();
    }

    public function getSubmissionFee()
    {
        $this->submission_fee = Prices::where('price_type', 'submission')
                                       ->where('start_date', '<=', now())
                                       ->where(function($query) {
                                           $query->where('end_date', '>', now())
                                                 ->orWhere('end_date', null);
                                       })
                                       ->orderBy('start_date')
                                       ->first();
    }

    public function getSubmissionDate()
    {
        $nextSubmissionDate = SubmissionDate::where('admission_date', '>', now()->subDay())
                                            ->orderBy('admission_date', 'ASC')
                                            ->first()->admission_date;

        $this->next_admission_date = Carbon::parse($nextSubmissionDate)->toFormattedDayDateString();

        $this->next_admission_date_difference = Carbon::parse($nextSubmissionDate)->diffForHumans();
    }

    public function payFee($price_type)
    {
        try {
            $price = Prices::where('price_type', $price_type)
                           ->where('start_date', '<=', now())
                           ->where(function ($query) {
                               $query->where('end_date', '>', now())
                                     ->orWhere('end_date', null);
                           })
                           ->orderBy('start_date')
                           ->firstOrFail();

            $stripe = new StripeClient(Config('stripe.secret'));

            $amount = $price->amount * 100;
            $email  = Auth::user()->email;

            $description = '';
            if ($price->price_type === 'registration') {
                $description = 'Registration fee for the Chartered Practitioners Register.';
            }
            if ($price->price_type === 'submission') {
                $description = 'Submission fee for the Chartered Practitioners Register.';
            }

            $checkout_session = $stripe->checkout->sessions->create([
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'gbp',
                        'product_data' => [
                            'name' => Str($price->price_type)->headline() . ' Fee',
                            'description' => $description,
                        ],
                        'unit_amount' => $amount,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'customer_email' => $email,
                'success_url' => route('payment-success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
                'cancel_url' => route('payment-cancel', [], true),
            ]);

            $order = new Order();
            $order->order_status = 'unpaid';
            $order->product_name = $price->price_type;
            $order->total_price = $price->amount;
            $order->stripe_session_id = $checkout_session->id;
            $order->user_id = Auth::user()->id;
            $order->save();

            return redirect($checkout_session->url);

        } catch (\Exception $e) {
            $err_message = 'Unable to make payment. ';

            if (Config('app.env') !== 'Production') {
                $err_message = $e->getMessage();
            } else {
                Log::error($e->getMessage());
            }

            $this->alert('error', 'Ayo: ' . $err_message, [
                'position' => 'center',
                'timer' => null,
                'showConfirmButton' => true,
                'confirmButtonColor' => '#dc2626',
            ]);
        }
    }

    public function render()
    {
        $this->logged_in_user = Auth::user();

        return view('livewire.pages.cpr.dashboard')
            ->layout('layouts.app');
    }
}
