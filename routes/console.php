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

/*
 * Promote Applicants to Registrants
 * Runs just after midnight to allow for any discrepancy between server
 * and database clocks.
 */
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
            $user->became_registrant_at    = date('Y-m-d');
            $user->registration_expires_at = date('Y-m-d', strtotime('+1 year'));
            $user->save();
        }
    }
})->dailyAt('00:10');

/*
 * Demote Registrants who have not completed their
 * CPD (Continuous Professional Development)
 * and/or paid their renewal fee.
 * Includes a grace period of 3 months.
 */
Schedule::call(function () {
    $grace_date = Carbon::now()->subMonths(3);
    $expired_users = User::role('registrant')
                         ->where('registration_expires_at', '<', $grace_date)
                         ->get();

    foreach ($expired_users as $user) {
        $user->removeRole('registrant');
        $user->assignRole('lapsed registrant');

        if (config('app.env') === 'production') {
            Mail::to($user->email)
                ->send(new RegistrationExpiredNotification($user));
        }
    }
})->dailyAt('00:20'); // staggered to minimise load on server.

/*
 * Admins can manually set lapsed registrants back to active registrant status.
 * This scheduled task checks for and resets active registrants whose expiry
 * date is more than a year ago back to lapsed status. This is necessary as
 * registrants are only able to add a year to their existing expiry date.
 * Emails are not sent on this occasion.
 */
Schedule::call(function () {
    $year_ago      = Carbon::now()->subYear();
    $expired_users = User::role('registrant')
                         ->where('registration_expires_at', '<', $year_ago)
                         ->get();

    foreach ($expired_users as $user) {
        $user->removeRole('registrant');
        $user->assignRole('lapsed registrant');
    }
})->dailyAt('00:30'); // staggered to minimise load on server.


/*
 * Send reminder emails to users whose registrations are close to expiring
 */
Schedule::call(function () {
    if (config('app.env') === 'production') {
        $four_weeks_from_now = Carbon::now()->addDays(28)->format('Y-m-d');
        $expiring_users      = User::role('registrant')
                                   ->where('registration_expires_at', $four_weeks_from_now)
                                   ->get();
        foreach ($expiring_users as $user) {
            Mail::to($user->email)
                ->send(new RegistrationExpiringNotification($user));
        }
    }
})->dailyAt('00:40'); // staggered to minimise load on server.

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
