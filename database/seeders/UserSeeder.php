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
//            'title'        => 'Mr.',
            'first_name'   => 'Sam',
            'last_name'    => 'Green',
            'email'        => 'sam@asapcomputers.co.uk',
            'password'     => Hash::make('asap3434'),
        ]);
        $me->assignRole('admin');

        $testAdmin = User::factory()->create([
            'first_name'   => 'Dan',
            'last_name'    => 'Jones',
            'email'        => 'danjones@test.co.uk',
            'password'     => Hash::make('admin-test'),
        ]);
        $testAdmin->assignRole('admin');

        // Random admins
//        User::factory()->count(3)->create()->each(function ($user) {
//            $user->assignRole('admin');
//            $user->eoi_status = 'n/a';
//            $user->submission_status = 'n/a';
//            $user->save();
//        });


        // Pending applicant
        $test_applicant = User::factory()->create([
           'first_name'   => 'Test',
           'last_name'    => 'Applicant',
           'email'        => 'software-callback@asapcomputers.co.uk',
           'password'     => Hash::make('asap3434'),
        ]);
        $test_applicant->assignRole('applicant');

        $test_applicant2 = User::factory()->create([
            'first_name'   => 'James',
            'last_name'    => 'Smith',
            'email'        => 'jamessmith@test.co.uk',
            'password'     => Hash::make('applicant-test'),
        ]);
        $test_applicant2->assignRole('applicant');

        User::factory()->count(3)->create()->each(function ($user) {
            $user->assignRole('applicant');
            $user->registration_fee_paid = true;
            $user->save();
        });
//        User::factory()->count(3)->create()->each(function ($user) {
//            $user->assignRole('applicant');
//            $user->registration_fee_paid = true;
//            $user->save();
//        });
        User::factory()->count(7)->create()->each(function ($user) {
            $user->assignRole('applicant');
        });


        // Accepted applicant
        User::factory()->count(4)->create()->each(function ($user) {
            $user->assignRole('accepted applicant');
            $user->submission_interview_at = fake()->dateTimeBetween('-40 days', '-21 days')->format('Y-m-d H:i:s');
            $user->submission_accepted_at = fake()->dateTimeBetween('-20 days', '-1 days')->format('Y-m-d H:i:s');
            $user->submission_accepted_by = 1;
            $user->eoi_status = 'accepted';
            $user->registration_fee_paid = true;
            $user->submission_status = 'accepted';
            $user->submission_fee_paid = true;
            $user->registration_pathway = fake()->randomElement(['personal','standard']);
            $user->save();
        });

        // Blocked applicant
        User::factory()->count(12)->create()->each(function ($user) {
            $user->assignRole('blocked applicant');
            $user->declined_at = fake()->dateTimeBetween('-10 years', '-1 days')->format('Y-m-d H:i:s');
            $user->declined_by = 1;
            $user->save();
        });

        // Active registrant, not expiring anytime soon
        User::factory()->count(47)->create()->each(function ($user) {
            $became_registrant_at = fake()->dateTimeBetween('-10 years', '-1 days')->format('Y-m-d H:i:s');
            $submission_accepted_at = Carbon::parse($became_registrant_at)->subDays(fake()->numberBetween(1,30))->format('Y-m-d H:i:s');

            $user->assignRole('registrant');
            $user->submission_accepted_at = $submission_accepted_at;
            $user->submission_accepted_by = 1;
            $user->eoi_status = 'accepted';
            $user->registration_expires_at = fake()->dateTimeBetween('+60 days', '+364 days')->format('Y-m-d');
            $user->became_registrant_at = Carbon::parse($became_registrant_at)->format('Y-m-d');
            $user->registration_fee_paid = true;
            $user->registration_pathway = fake()->randomElement(['personal','standard']);
            $user->submission_status = 'accepted';
            $user->submission_fee_paid = true;
            $user->save();
        });

        // Active registrant, expiring soon
        User::factory()->count(5)->create()->each(function ($user) {
            $became_registrant_at = fake()->dateTimeBetween('-10 years', '-1 days')->format('Y-m-d H:i:s');
            $submission_accepted_at = Carbon::parse($became_registrant_at)->subDays(fake()->numberBetween(1,30))->format('Y-m-d H:i:s');

            $user->assignRole('registrant');
            $user->submission_accepted_at = $submission_accepted_at;
            $user->submission_accepted_by = 1;
            $user->eoi_status = 'accepted';
            $user->registration_pathway = fake()->randomElement(['personal','standard']);
            $user->registration_expires_at = fake()->dateTimeBetween('+1 days', '+30 days')->format('Y-m-d');
            $user->became_registrant_at = Carbon::parse($became_registrant_at)->format('Y-m-d');
            $user->registration_fee_paid = true;
            $user->submission_status = 'accepted';
            $user->submission_fee_paid = true;
            $user->save();
        });

        // Lapsed registrant
        User::factory()->count(5)->create()->each(function ($user) {
            $became_registrant_at = fake()->dateTimeBetween('-18 years', '-11 years')->format('Y-m-d H:i:s');
            $submission_accepted_at = Carbon::parse($became_registrant_at)->subDays(fake()->numberBetween(1,30))->format('Y-m-d H:i:s');

            $user->assignRole('lapsed registrant');
            $user->submission_accepted_at = $submission_accepted_at;
            $user->submission_accepted_by = 1;
            $user->eoi_status = 'accepted';
            $user->registration_pathway = fake()->randomElement(['personal','standard']);
            $user->registration_expires_at = fake()->dateTimeBetween('-10 years', '-1 days')->format('Y-m-d');
            $user->became_registrant_at = Carbon::parse($became_registrant_at)->format('Y-m-d');
            $user->registration_fee_paid = true;
            $user->submission_status = 'accepted';
            $user->submission_fee_paid = true;
            $user->save();
        });
    }
}
