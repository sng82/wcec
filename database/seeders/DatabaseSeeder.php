<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'first_name'   => 'Sam',
             'last_name'    => 'Green',
             'email'        => 'sam@asapcomputers.co.uk',
             'password'     => Hash::make('asap3434'),
             'account_type' => 'admin',
         ]);

         \App\Models\SubmissionDate::factory(3)->create();

         \App\Models\Prices::factory()->create([
             'type' => 'eoi',
             'price' => 50.00,
             'from_date' => '2024-01-01',
             'updated_by' => 1
         ]);

        \App\Models\Prices::factory()->create([
            'type' => 'submission',
            'price' => 500.00,
            'from_date' => '2024-01-01',
            'updated_by' => 1
        ]);

        \App\Models\Prices::factory()->create([
            'type' => 'renewal',
            'price' => 200.00,
            'from_date' => '2024-01-01',
            'updated_by' => 1
        ]);
    }
}
