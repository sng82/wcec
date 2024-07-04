<?php

use App\Models\SubmissionDate;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

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

Schedule::call(function () {
    $next_submission_date = SubmissionDate::where('submission_date', '>=', date('Y-m-d'))
                                          ->orderBy('submission_date', 'desc')
                                          ->first()->submission_date;

    if ($next_submission_date === date('Y-m-d')) {
        $users_to_update = User::where('application_status', 'accepted')
                               ->where('registration_fee_paid', 1)
                               ->where('application_fee_paid', 1)
                               ->whereNull('became_member_at')
                               ->whereNull('membership_expires_at')
                               ->get();
        foreach ($users_to_update as $user) {
            $user->removeRole('accepted_applicant');
            $user->assignRole('member');
            $user->became_member_at = date('Y-m-d');
            $user->membership_expires_at = date('Y-m-d', strtotime('+1 year'));
            $user->save();
        }
    }
})->daily();
