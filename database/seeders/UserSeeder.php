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
        // \App\Models\User::factory(10)->create();

        $me = User::factory()->create([
            'first_name'   => 'Sam',
            'last_name'    => 'Green',
            'email'        => 'sam@asapcomputers.co.uk',
            'password'     => Hash::make('asap3434'),
//            'account_type' => 'admin',
        ]);

        $me->assignRole('admin');

        User::factory()->count(3)->create()->each(function ($user) {
            $user->assignRole('admin');
        });

        User::factory()->count(12)->create()->each(function ($user) {
            $user->assignRole('applicant');
        });

        User::factory()->count(4)->create()->each(function ($user) {
            $user->assignRole('accepted applicant');
            $user->accepted_at = fake()->dateTimeBetween('-20 days', '-1 days')->format('Y-m-d H:i:s');
            $user->accepted_by = 1;
            $user->save();
        });

        User::factory()->count(2)->create()->each(function ($user) {
            $user->assignRole('blocked applicant');
            $user->declined_at = fake()->dateTimeBetween('-10 years', '-1 days')->format('Y-m-d H:i:s');
            $user->declined_by = 1;
            $user->save();
        });

//        User::factory()->count(30)->create([
//            'membership_expires_at' => fake()->dateTimeBetween('+1 days', '+364 days')->format('Y-m-d'),
//        ])->each(function ($user) {
//            $user->assignRole('member');
//        });

        User::factory()->count(30)->create()->each(function ($user) {

            $became_member_at = fake()->dateTimeBetween('-10 years', '-1 days')->format('Y-m-d H:i:s');
            $accepted_at = Carbon::parse($became_member_at)->subDays(fake()->numberBetween(1,30))->format('Y-m-d H:i:s');

            $user->assignRole('member');
            $user->accepted_at = $accepted_at;
            $user->accepted_by = 1;
            $user->membership_expires_at = fake()->dateTimeBetween('+1 days', '+364 days')->format('Y-m-d');
            $user->became_member_at = Carbon::parse($became_member_at)->format('Y-m-d');
            $user->save();
        });

        User::factory()->count(6)->create()->each(function ($user) {

            $became_member_at = fake()->dateTimeBetween('-18 years', '-11 years')->format('Y-m-d H:i:s');
            $accepted_at = Carbon::parse($became_member_at)->subDays(fake()->numberBetween(1,30))->format('Y-m-d H:i:s');

            $user->assignRole('lapsed member');
            $user->accepted_at = $accepted_at;
            $user->accepted_by = 1;
            $user->membership_expires_at = fake()->dateTimeBetween('-10 years', '-1 days')->format('Y-m-d');
            $user->became_member_at = Carbon::parse($became_member_at)->format('Y-m-d');
            $user->save();
        });
    }
}
