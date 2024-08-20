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
    public $renewal_fee;
    public $renewal_due;
    public $renewal_fee_due;
    public $cpd_due;
    public $renewal_window = 3; //how long, in months, before their registration expires that a user can renew.

    public function mount()
    {
        $this->updateRegistrationExpiryDate();

        $this->getAdmissionDate();
        $this->getEOIs();
        $this->getSubmissions();
        $this->getExpiringRegistrations();
        $this->getSubmissionFee();
        $this->getRegistrationFee();
        $this->getRenewalFee();
        $this->getRenewalDue();
        $this->getRenewalFeeDue(); // must come after getRenewalDue!
        $this->getCpdDue(); // must come after getRenewalDue!


    }

    public function openMember($id)
    {
        $this->redirect('user-edit/' . $id);
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
                                            ->where(function($query) {
                                                $query->where('submission_status', 'submitted')
                                                      ->orWhere('submission_status', 'awaiting_interview');
                                            })

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

    public function getRenewalFee()
    {
        $this->renewal_fee = Prices::where('price_type', 'renewal')
                                   ->where('start_date', '<=', now())
                                   ->where(function($query) {
                                       $query->where('end_date', '>', now())
                                             ->orWhere('end_date', null);
                                   })
                                   ->orderBy('start_date')
                                   ->first();
    }

    public function getAdmissionDate()
    {
        $nextSubmissionDate = SubmissionDate::where('admission_date', '>', now()->subDay())
                                            ->orderBy('admission_date', 'ASC')
                                            ->first()->admission_date;

        $this->next_admission_date = Carbon::parse($nextSubmissionDate)->toFormattedDayDateString();

        $this->next_admission_date_difference = Carbon::parse($nextSubmissionDate)->diffForHumans();
    }

    public function getRenewalDue()
    {
        $user = Auth::user();
        $this->renewal_due = $user?->registrationCanBeRenewed() ?: false;

//        $is_registrant = $user?->hasRole('registrant');
//
//        if (
//            ($is_registrant) &&
//            (Carbon::parse($user?->registration_expires_at) > Carbon::now()) &&
//            (Carbon::parse($user?->registration_expires_at) < Carbon::now()->addMonths($this->renewal_window))
//        ) {
//            $this->renewal_due = true;
//        } else {
//            $this->renewal_due = false;
//        }
    }

    public function getRenewalFeeDue()
    {
        $user = Auth::user();
        $this->renewal_fee_due = $user?->registrationRenewalCanBePaid() ?: false;
//        $is_registrant = $user?->hasRole('registrant');
//
//        if (
//            ($is_registrant) &&
//            ($this->renewal_due) &&
//            (Carbon::parse($user?->renewal_fee_last_paid_at) < Carbon::now()->subMonths($this->renewal_window))
//        ) {
//            $this->renewal_fee_due = true;
//        } else {
//            $this->renewal_fee_due = false;
//        }
    }

    public function getCpdDue()
    {
        $user = Auth::user();
        $this->cpd_due = $user?->cpdCanBeSubmitted() ?: false;

//        $is_registrant = $user?->hasRole('registrant');
//
//        if (
//            ($is_registrant) &&
//            ($this->renewal_due) &&
//            (Carbon::parse($user?->cpd_last_submitted_at) < Carbon::now()->subMonths($this->renewal_window))
//        ) {
//            $this->cpd_due = true;
//        } else {
//            $this->cpd_due = false;
//        }
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

            $stripe = new StripeClient(config('stripe.secret'));

            $amount = $price->amount * 100;
            $email  = Auth::user()->email;

            $description = '';
            if ($price->price_type === 'registration') {
                $description = 'Registration fee for the Chartered Practitioners Register.';
            }
            if ($price->price_type === 'submission') {
                $description = 'Submission fee for the Chartered Practitioners Register.';
            }
            if ($price->price_type === 'renewal') {
                $description = 'Renewal fee for the Chartered Practitioners Register.';
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
                'automatic_tax' => ['enabled' => true],
                'mode' => 'payment',
                'customer_email' => $email,
                // @NOTE: Stripe acct can be configured to automatically send receipts from dashboard.
                // Not sure if Invoices can or should be created/sent as it looks like it might be a premium feature.
                // more here: https://docs.stripe.com/receipts?payment-ui=checkout&locale=en-GB#paid-invoices
                // Invoice pricing here: https://support.stripe.com/questions/pricing-for-post-payment-invoices-for-one-time-purchases-via-checkout-and-payment-links

                // Uncomment the following line to enable invoices.
//                'invoice_creation' => [
//                    'enabled' => true,
//                ],

                'success_url' => route('payment-success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
                'cancel_url' => route('payment-cancel', [], true),
            ]);

            $order = new Order();
            $order->order_status = 'unpaid';
            $order->product_name = $price->price_type;
            $order->price_ex_vat = $price->amount;
            $order->stripe_session_id = $checkout_session->id;
            $order->user_id = Auth::user()->id;
            $order->save();

            return redirect($checkout_session->url);

        } catch (\Exception $e) {
            $err_message = 'Unable to make payment. ';

            if (config('app.env') !== 'Production') {
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

    private function updateRegistrationExpiryDate(): void
    {
        $user = Auth::user();
        $is_registrant = $user?->hasRole('registrant');

        if ($user && $is_registrant) {

            if(Carbon::parse($user->registration_expires_at) < Carbon::parse(now())->addYear()) {
                $new_expires_at = Carbon::parse($user->registration_expires_at)->addYear();
                $user->update([
                    'registration_expires_at' => $new_expires_at
                ]);
            }

//            $oldest_valid_date = Carbon::now()->subMonths($this->renewal_window);
//            if (
//                Carbon::parse($user->renewal_fee_last_paid_at) >= Carbon::parse($oldest_valid_date)
//                &&
//                Carbon::parse($user->cpd_last_submitted_at) >= Carbon::parse($oldest_valid_date)
//                &&
//                Carbon::parse($user->registration_expires_at) < Carbon::parse(now())->addYear()
//            ) {
//                $new_expires_at = Carbon::parse($this->user->registration_expires_at)->addYear();
//                $user->update([
//                    'registration_expires_at' => $new_expires_at
//                ]);
//            }
        }
    }

    public function render()
    {
        $this->logged_in_user = Auth::user();

        return view('livewire.pages.cpr.dashboard')
            ->layout('layouts.app');
    }
}
