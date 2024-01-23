<?php

use App\Livewire\Pages\About;
use App\Livewire\Pages\CharitableTrust;
use App\Livewire\Pages\CharteredPractitioners;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Court;
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
Route::get('/court', Court::class)->name('court');
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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/cpr/dashboard', Dashboard::class)->name('dashboard');
});

//Route::view('dashboard', 'dashboard')
//    ->middleware(['auth', 'verified'])
//    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
