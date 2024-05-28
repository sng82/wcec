<?php

namespace Database\Seeders;

use App\Models\User;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Me
        $me = User::factory()->create([
            'first_name'   => 'Sam',
            'last_name'    => 'Green',
            'email'        => 'sam@asapcomputers.co.uk',
            'password'     => Hash::make('asap3434'),
        ]);
        $me->assignRole('admin');

        // Random admins
        User::factory()->count(3)->create()->each(function ($user) {
            $user->assignRole('admin');
        });

        // Pending applicant
        User::factory()->count(4)->create()->each(function ($user) {
            $user->assignRole('applicant');
            $user->eoi_fee_paid = true;
            $user->submission_fee_paid = true;
            $user->save();
        });
        User::factory()->count(3)->create()->each(function ($user) {
            $user->assignRole('applicant');
            $user->eoi_fee_paid = true;
            $user->save();
        });
        User::factory()->count(2)->create()->each(function ($user) {
            $user->assignRole('applicant');
        });

        // Accepted applicant
        User::factory()->count(4)->create()->each(function ($user) {
            $user->assignRole('accepted applicant');
            $user->accepted_at = fake()->dateTimeBetween('-20 days', '-1 days')->format('Y-m-d H:i:s');
            $user->accepted_by = 1;
            $user->eoi_fee_paid = true;
            $user->submission_fee_paid = true;
            $user->save();
        });

        // Blocked applicant
        User::factory()->count(25)->create()->each(function ($user) {
            $user->assignRole('blocked applicant');
            $user->declined_at = fake()->dateTimeBetween('-10 years', '-1 days')->format('Y-m-d H:i:s');
            $user->declined_by = 1;
            $user->save();
        });

        // Active member, not expiring anytime soon
        User::factory()->count(295)->create()->each(function ($user) {
            $became_member_at = fake()->dateTimeBetween('-10 years', '-1 days')->format('Y-m-d H:i:s');
            $accepted_at = Carbon::parse($became_member_at)->subDays(fake()->numberBetween(1,30))->format('Y-m-d H:i:s');

            $user->assignRole('member');
            $user->accepted_at = $accepted_at;
            $user->accepted_by = 1;
            $user->membership_expires_at = fake()->dateTimeBetween('+60 days', '+364 days')->format('Y-m-d');
            $user->became_member_at = Carbon::parse($became_member_at)->format('Y-m-d');
            $user->eoi_fee_paid = true;
            $user->submission_fee_paid = true;
            $user->save();
        });

        // Active member, expiring soon
        User::factory()->count(5)->create()->each(function ($user) {
            $became_member_at = fake()->dateTimeBetween('-10 years', '-1 days')->format('Y-m-d H:i:s');
            $accepted_at = Carbon::parse($became_member_at)->subDays(fake()->numberBetween(1,30))->format('Y-m-d H:i:s');

            $user->assignRole('member');
            $user->accepted_at = $accepted_at;
            $user->accepted_by = 1;
            $user->membership_expires_at = fake()->dateTimeBetween('+1 days', '+30 days')->format('Y-m-d');
            $user->became_member_at = Carbon::parse($became_member_at)->format('Y-m-d');
            $user->eoi_fee_paid = true;
            $user->submission_fee_paid = true;
            $user->save();
        });

        // Lapsed member
        User::factory()->count(45)->create()->each(function ($user) {
            $became_member_at = fake()->dateTimeBetween('-18 years', '-11 years')->format('Y-m-d H:i:s');
            $accepted_at = Carbon::parse($became_member_at)->subDays(fake()->numberBetween(1,30))->format('Y-m-d H:i:s');

            $user->assignRole('lapsed member');
            $user->accepted_at = $accepted_at;
            $user->accepted_by = 1;
            $user->membership_expires_at = fake()->dateTimeBetween('-10 years', '-1 days')->format('Y-m-d');
            $user->became_member_at = Carbon::parse($became_member_at)->format('Y-m-d');
            $user->eoi_fee_paid = true;
            $user->submission_fee_paid = true;
            $user->save();
        });
    }
}
