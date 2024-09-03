<?php

use App\Http\Controllers\StripeController;
use App\Livewire\Pages\About;
use App\Livewire\Pages\CharitableTrust;
use App\Livewire\Pages\CharteredPractitioners;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Cpr\AdminEoi;
use App\Livewire\Pages\Cpr\AdminMembers;
use App\Livewire\Pages\Cpr\AdminPreviewEmails;
use App\Livewire\Pages\Cpr\AdminPrivateDocuments;
use App\Livewire\Pages\Cpr\AdminPublicDocuments;
use App\Livewire\Pages\Cpr\AdminSubmission;
use App\Livewire\Pages\Cpr\AdmissionDates;
use App\Livewire\Pages\Cpr\ApplicantDocuments;
use App\Livewire\Pages\Cpr\ApplicantEoi;
use App\Livewire\Pages\Cpr\ApplicantFees;
use App\Livewire\Pages\Cpr\ApplicantHelp;
use App\Livewire\Pages\Cpr\ApplicantSubmission;
use App\Livewire\Pages\Cpr\AssessEoi;
use App\Livewire\Pages\Cpr\AssessSubmission;
//use App\Livewire\Pages\Cpr\Payment;
use App\Livewire\Pages\Cpr\MyDetails;
use App\Livewire\Pages\Cpr\PaymentCancel;
use App\Livewire\Pages\Cpr\PaymentSuccess;
use App\Livewire\Pages\Cpr\Prices;
use App\Livewire\Pages\Cpr\PrintEoi;
//use App\Livewire\Pages\Cpr\StripePayment;
use App\Livewire\Pages\Cpr\RegistrantCpd;
use App\Livewire\Pages\Cpr\UserAdd;
use App\Livewire\Pages\Cpr\UserEdit;
use App\Livewire\Pages\CprComingSoon;
//use App\Livewire\Pages\CprEoi;
use App\Livewire\Pages\Officers;
use App\Livewire\Pages\Cpr\Dashboard;
use App\Livewire\Pages\History;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Membership;
use App\Livewire\Pages\OurChurch;
use App\Livewire\Pages\Supporters;
use App\Livewire\Pages\Supporting;
use App\Livewire\Pages\WhereWeMeet;
use App\Models\EOI;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//---------------------------------------------//
//---------------------------------------------//
// Public Pages
//---------------------------------------------//
//---------------------------------------------//


Route::get('/', Home::class)->name('home');

// The Company Pages
Route::get('/membership', Membership::class)->name('membership');
Route::get('/officers', Officers::class)->name('officers');
Route::get('/history', History::class)->name('history');
Route::get('/supporting', Supporting::class)->name('supporting');


// Other Pages
Route::get('/about', About::class)->name('about');
Route::get('/charitable-trust', CharitableTrust::class)->name('charitable-trust');
Route::get('/chartered-practitioners', CharteredPractitioners::class)->name('chartered-practitioners');
Route::get('/contact', Contact::class)->name('contact');

//Route::get('/supporters', Supporters::class)->name('supporters');
//Route::get('/our-church', OurChurch::class)->name('our-church');
//Route::get('/where-we-meet', WhereWeMeet::class)->name('where-we-meet');

// CPR Offline pages
Route::get('/cpr-coming-soon', CprComingSoon::class)->name('cpr-coming-soon');
Route::get('/register', CprComingSoon::class)->name('cpr-coming-soon');


//---------------------------------------------//
//---------------------------------------------//
// Chartered Practitioners Portal
//---------------------------------------------//
//---------------------------------------------//

Route::get('/cpr/payment-success', PaymentSuccess::class)->name('payment-success');
Route::get('/cpr/payment-cancel', PaymentCancel::class)->name('payment-cancel');

// Routes accessible to all logged-in users.
Route::group(['middleware' => ['auth']], function () {
    Route::get('/cpr/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/cpr/my-details', MyDetails::class)->name('my-details');
});

// Admin routes
Route::group(['middleware' => ['role:admin', 'auth']], function () {
    Route::get('/cpr/prices', Prices::class)->name('prices');
    Route::get('/cpr/registrants', AdminMembers::class)->name('registrants');
    Route::get('/cpr/admission-dates', AdmissionDates::class)->name('admission-dates');
    Route::get('/cpr/public-documents', AdminPublicDocuments::class)->name('public-documents');
    Route::get('/cpr/private-documents', AdminPrivateDocuments::class)->name('private-documents');
    Route::get('/cpr/user-edit/{id}', UserEdit::class)->name('user-edit');
    Route::get('/cpr/user-add', UserAdd::class)->name('user-add');
    Route::get('/cpr/assess-eoi/{id}', AssessEoi::class)->name('assess-eoi');
    Route::get('/cpr/assess-submission/{id}', AssessSubmission::class)->name('assess-submission');
    Route::get('/cpr/email-previews', AdminPreviewEmails::class)->name('preview-emails');

    Route::get('/mail/preview/interview-notification', function () {
        $user = User::factory()->make();
        $feedback = 'This is an example of some feedback.';
        return new App\Mail\ApplicantInterviewNotification($user, $feedback);
    });

    Route::get('/mail/preview/registrant-fee-paid', function () {
        $order = Order::factory()->make();
        $user = User::factory()->make();
        return new App\Mail\CPRFeePaidUserNotification($order, $user);
    });

    Route::get('/mail/preview/admin-fee-paid', function () {
        $order = Order::factory()->make();
        $user = User::factory()->make();
        return new App\Mail\CPRFeePaidAdminNotification($order, $user);
    });

    Route::get('/mail/preview/eoi-accepted', function () {
        $user = User::factory()->make();
        return new App\Mail\ExpressionAccepted($user);
    });

    Route::get('/mail/preview/eoi-unaccepted', function () {
        $user = User::factory()->make();
        $eoi = EOI::factory()->make();
        return new App\Mail\ExpressionUnaccepted($user, $eoi);
    });

    Route::get('/mail/preview/eoi-rejected', function () {
        $user = User::factory()->make();
        $eoi = EOI::factory()->make();
        return new App\Mail\ExpressionRejected($user, $eoi);
    });

    Route::get('/mail/preview/eoi-submitted', function () {
        $user = User::factory()->make();
        return new App\Mail\ExpressionSubmittedNotification($user);
    });

    Route::get('/mail/preview/submission-submitted', function () {
        $user = User::factory()->make();
        return new App\Mail\SubmissionSubmittedNotification($user);
    });

    Route::get('/mail/preview/login-instructions', function () {
        $user = User::factory()->make();
        return new App\Mail\NewUserLoginInstructions($user);
    });

    Route::get('/mail/preview/registration-expiring', function () {
        $user = User::factory()->make();
        return new App\Mail\RegistrationExpiringNotification($user);
    });

    Route::get('/mail/preview/registration-expired', function () {
        $user = User::factory()->make();
        return new App\Mail\RegistrationExpiredNotification($user);
    });

});



// Used to build printable PDF of data submitted for an EOI.
Route::get('/cpr/print-eoi/{id}/{obfuscation_key}', PrintEoi::class)->name('print-eoi');

// Applicant Routes
Route::group(['middleware' => ['role:applicant', 'auth']], function () {
    Route::get('/cpr/applicant-documents', ApplicantDocuments::class)->name('applicant-documents');
    Route::get('/cpr/applicant-help', ApplicantHelp::class)->name('applicant-help');
    Route::get('/cpr/applicant-eoi', ApplicantEoi::class)->name('applicant-eoi');
    Route::get('/cpr/applicant-fees', ApplicantFees::class)->name('applicant-fees');
    Route::get('/cpr/applicant-submission', ApplicantSubmission::class)->name('applicant-submission');
});

// Registrant Routes
Route::group(['middleware' => ['role:registrant', 'auth']], function () {
    Route::get('/cpr/registrant-cpd', RegistrantCpd::class)->name('registrant-cpd');
});

//---------------------------------------------//
//---------------------------------------------//
// Miscellaneous
//---------------------------------------------//
//---------------------------------------------//

// Stripe webhook access point
Route::post('/stripe/webhook', [StripeController::class, 'webhook'])->name('stripe.webhook');

//Route::view('profile', 'profile')
//    ->middleware(['auth'])
//    ->name('profile');

require __DIR__.'/auth.php';
