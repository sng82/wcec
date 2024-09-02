<?php

use App\Mail\RegistrationExpiredNotification;
use App\Mail\RegistrationExpiringNotification;
use App\Models\SubmissionDate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Promote Applicants to Registrants
Schedule::call(function () {
    $next_admission_date = SubmissionDate::where('admission_date', '>=', date('Y-m-d'))
                                          ->orderBy('admission_date', 'asc')
                                          ->first()->admission_date;

    if ($next_admission_date === date('Y-m-d')) {
        $accepted_applicants = User::role('accepted applicant')
                                   ->where('submission_status', 'accepted')
                                   ->where('registration_fee_paid', 1)
                                   ->where('submission_fee_paid', 1)
                                   ->where('submission_accepted_at', '<=', $next_admission_date->submission_deadline)
                                   ->whereNull('became_registrant_at')
                                   ->whereNull('registration_expires_at')
                                   ->get();

        foreach ($accepted_applicants as $user) {
            $user->removeRole('accepted applicant');
            $user->assignRole('registrant');
            $user->became_registrant_at = date('Y-m-d');
            $user->registration_expires_at = date('Y-m-d', strtotime('+1 year'));
            $user->save();
        }
    }
})->dailyAt('00:10'); // run just after midnight to allow for any discrepancy between server and database clocks.

// Demote Registrants who have not completed their CPD (Continuous Professional Development)
// and/or paid their renewal fee.
Schedule::call(function () {
   $expired_users = User::role('registrant')
                        ->where('registration_expires_at', '<', date('Y-m-d'))
                        ->get();

   foreach ($expired_users as $user) {
       $user->removeRole('registrant');
       $user->assignRole('lapsed registrant');
       Mail::to($user->email)
           ->send(new RegistrationExpiredNotification($user));
   }
})->dailyAt('00:20'); // run a little later than the last call, just to minimise load on server.

// Send reminder emails to users whose registrations are close to expiring
Schedule::call(function () {
    $four_weeks_from_now = Carbon::now()->addDays(28)->format('Y-m-d');
    $expiring_users = User::role('registrant')
                          ->where('registration_expires_at', $four_weeks_from_now)
                          ->get();

    foreach ($expiring_users as $user) {
        Mail::to($user->email)
            ->send(new RegistrationExpiringNotification($user));
    }

})->dailyAt('00:30'); // run a little later than the last call, just to minimise load on server.


// Tests
Artisan::command('send_test_expiring_email', function () {
    try {
        $user = User::find(1);
        Mail::to($user->email)
            ->send(new RegistrationExpiringNotification($user));
        print 'sent';
    } catch (Exception $e) {
        print 'not sent | ' . $e->getMessage();
    }
});

Artisan::command('send_test_expired_email', function () {
    try {
        $user = User::find(1);
        Mail::to($user->email)
            ->send(new RegistrationExpiredNotification($user));
        print 'sent';
    } catch (Exception $e) {
        print 'not sent | ' . $e->getMessage();
    }
});
