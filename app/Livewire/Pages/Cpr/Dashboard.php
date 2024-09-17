<?php

namespace App\Livewire\Pages\Cpr;

use App\Models\Order;
use App\Models\Prices;
use App\Models\SubmissionDate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
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
    public $overdue_registrations = '';
    public $logged_in_user;
    public $submission_fee;
    public $registration_fee;
    public $renewal_fee;
    public $renewal_due;
    public $renewal_fee_due;
    public $cpd_due;

//    public $lapsed_can_renew;
    public $renewal_window = 1; //how long, in months, before their registration expires that a registrant can renew.

    public function mount()
    {
        $this->setRegistrationExpiryDate();

        $this->getAdmissionDate();
        $this->getEOIs();
        $this->getSubmissions();
        $this->getExpiringRegistrations();
        $this->getOverdueRegistrations();
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

    public function getOverdueRegistrations()
    {
        // registrants have a grace period between their registration
        // expiring and having their status changed to 'lapsed registrant'.

        $this->overdue_registrations = User::role('registrant')
                                           ->where('registration_expires_at', '<', now())
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
    }

    public function getRenewalFeeDue()
    {
        $user = Auth::user();
        $this->renewal_fee_due = $user?->registrationRenewalCanBePaid() ?: false;
    }

    public function getCpdDue()
    {
        $user = Auth::user();
        $this->cpd_due = $user?->cpdCanBeSubmitted() ?: false;
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
//                    'enabled' => true
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

            $this->alert(
                'error',
                $err_message,
                [
                    'position' => 'center',
                    'timer' => null,
                    'showConfirmButton' => true,
                    'confirmButtonColor' => '#dc2626',
                ]
            );
        }
    }

    /*
     * Blocked applicants can reapply 12 months after they're unsuccessful.
     */
    public function reApply()
    {
        try {
            if ($this->logged_in_user->hasRole('blocked applicant')) {

                $this->logged_in_user->update([
                    'registration_fee_paid'     => 0,
                    'eoi_status'                => null,
                    'submission_fee_paid'       => 0,
                    'submission_status'         => null,
                    'submission_interview_at'   => null,
                    'submission_accepted_at'    => null,
                    'submission_accepted_by'    => null,
                    'registration_pathway'      => null,
                    'became_registrant_at'      => null,
                    'cpd_last_submitted_at'     => null,
                    'renewal_fee_last_paid_at'  => null,
                    'registration_expires_at'   => null,
                    'declined_at'               => null,
                    'declined_by'               => null,
                ]);

                $this->logged_in_user->removeRole('blocked applicant');
                $this->logged_in_user->assignRole('applicant');

                return $this->flash(
                    'success',
                    'Application status successfully reset',
                    [
                        'position' => 'top-end',
                        'timer' => 2000,
                        'showConfirmButton' => false,
                    ],
                    route('dashboard')
                );
            }

            $this->alert(
                'error',
                'Unable to reset account',
                [
                    'position'           => 'center',
                    'timer'              => null,
                    'showConfirmButton'  => true,
                    'confirmButtonColor' => '#dc2626',
                ]
            );
        } catch (\Exception $e) {
            $this->alert(
                'error',
                'Unable to reset account',
                [
                    'position'           => 'center',
                    'timer'              => null,
                    'showConfirmButton'  => true,
                    'confirmButtonColor' => '#dc2626',
                ]
            );
        }
    }

    private function setRegistrationExpiryDate(): void
    {
        $user = Auth::user();
        $is_registrant = $user?->hasRole('registrant');

        if ($user && $is_registrant) {

            $registration_expires_at    = !empty($user->registration_expires_at)
                                            ? Carbon::parse($user->registration_expires_at)
                                            : null;
            $cpd_last_submitted_at      = !empty($user->cpd_last_submitted_at)
                                            ? Carbon::parse($user->cpd_last_submitted_at)
                                            : null;
            $renewal_fee_last_paid_at   = !empty($user->renewal_fee_last_paid_at)
                                            ? Carbon::parse($user->renewal_fee_last_paid_at)
                                            : null;

            if (
                $registration_expires_at !== null &&
                $cpd_last_submitted_at !== null &&
                $renewal_fee_last_paid_at !== null &&
                $cpd_last_submitted_at > $registration_expires_at &&
                $renewal_fee_last_paid_at > $registration_expires_at
            ) {
                Log::debug('triggered');
                $user->update([
                    'registration_expires_at' => $registration_expires_at->addYear()
                ]);
            }
        }
    }

    public function render()
    {
        $this->logged_in_user = Auth::user();

        return view('livewire.pages.cpr.dashboard')
            ->layout('layouts.app');
    }
}
