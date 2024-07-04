<?php

use App\Http\Controllers\StripeController;
use App\Livewire\Pages\About;
use App\Livewire\Pages\CharitableTrust;
use App\Livewire\Pages\CharteredPractitioners;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Cpr\AdminMembers;
use App\Livewire\Pages\Cpr\ApplicantDocuments;
use App\Livewire\Pages\Cpr\ApplicantEoi;
use App\Livewire\Pages\Cpr\ApplicantFees;
use App\Livewire\Pages\Cpr\ApplicantHelp;
use App\Livewire\Pages\Cpr\AssessEoi;
use App\Livewire\Pages\Cpr\MemberAdd;
use App\Livewire\Pages\Cpr\MemberEdit;
//use App\Livewire\Pages\Cpr\Payment;
use App\Livewire\Pages\Cpr\PaymentCancel;
use App\Livewire\Pages\Cpr\PaymentSuccess;
use App\Livewire\Pages\Cpr\Prices;
use App\Livewire\Pages\Cpr\PrintEoi;
//use App\Livewire\Pages\Cpr\StripePayment;
use App\Livewire\Pages\Cpr\SubmissionDates;
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


// The Company Pages
Route::get('/', Home::class)->name('home');
Route::get('/membership', Membership::class)->name('membership');
Route::get('/officers', Officers::class)->name('officers');
Route::get('/where-we-meet', WhereWeMeet::class)->name('where-we-meet');
Route::get('/history', History::class)->name('history');
Route::get('/supporters', Supporters::class)->name('supporters');
Route::get('/supporting', Supporting::class)->name('supporting');
Route::get('/our-church', OurChurch::class)->name('our-church');

// Other Pages
Route::get('/charitable-trust', CharitableTrust::class)->name('charitable-trust');
Route::get('/chartered-practitioners', CharteredPractitioners::class)->name('chartered-practitioners');
Route::get('/about', About::class)->name('about');
Route::get('/contact', Contact::class)->name('contact');


//temp
Route::get('/cpr-coming-soon', CprComingSoon::class)->name('cpr-coming-soon');
Route::get('/register', CprComingSoon::class)->name('cpr-coming-soon');

Route::get('/cpr/payment-success', PaymentSuccess::class)->name('payment-success');
Route::get('/cpr/payment-cancel', PaymentCancel::class)->name('payment-cancel');

// Routes accessible to all logged-in users.
Route::group(['middleware' => ['auth']], function () {
    Route::get('/cpr/dashboard', Dashboard::class)->name('dashboard');
});

Route::group(['middleware' => ['role:admin', 'auth']], function () {
    Route::get('/cpr/prices', Prices::class)->name('prices');
    Route::get('/cpr/members', AdminMembers::class)->name('members');
    Route::get('/cpr/submission-dates', SubmissionDates::class)->name('submission-dates');
    Route::get('/cpr/member-edit/{id}', MemberEdit::class)->name('member-edit');
    Route::get('/cpr/member-add', MemberAdd::class)->name('member-add');
    Route::get('/cpr/assess-eoi/{id}', AssessEoi::class)->name('assess-eoi');
});

Route::group(['middleware' => ['role:applicant', 'auth']], function () {
    Route::get('/cpr/applicant-documents', ApplicantDocuments::class)->name('applicant-documents');
    Route::get('/cpr/applicant-help', ApplicantHelp::class)->name('applicant-help');
    Route::get('/cpr/applicant-eoi', ApplicantEoi::class)->name('applicant-eoi');
    Route::get('/cpr/applicant-fees', ApplicantFees::class)->name('applicant-fees');
});

Route::get('/cpr/print-eoi/{id}/{obfuscation_key}', PrintEoi::class)->name('print-eoi');

Route::post('/stripe/webhook', [StripeController::class, 'webhook'])->name('stripe.webhook');


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
