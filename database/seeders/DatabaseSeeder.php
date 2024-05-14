<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Prices;
use App\Models\SubmissionDate;
//use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
        ]);



        SubmissionDate::factory(3)->create();

        Prices::factory()->create([
            'price_type' => 'eoi',
            'amount'     => 30.00,
            'start_date'  => '2017-01-01',
            'end_date'    => '2020-01-01 23:59:59',
            'updated_by' => 1
        ]);

        Prices::factory()->create([
            'price_type' => 'submission',
            'amount'     => 350.00,
            'start_date'  => '2017-01-01',
            'end_date'    => '2020-01-01 23:59:59',
            'updated_by' => 1
        ]);

        Prices::factory()->create([
            'price_type' => 'renewal',
            'amount'     => 150.00,
            'start_date'  => '2017-01-01',
            'end_date'    => '2020-01-01 23:59:59',
            'updated_by' => 1
        ]);


        Prices::factory()->create([
            'price_type' => 'eoi',
            'amount'     => 40.00,
            'start_date'  => '2020-01-02',
            'end_date'    => '2024-01-01 23:59:59',
            'updated_by' => 1
        ]);

        Prices::factory()->create([
            'price_type' => 'submission',
            'amount'     => 400.00,
            'start_date'  => '2020-01-02',
            'end_date'    => '2024-02-01 23:59:59',
            'updated_by' => 1
        ]);

        Prices::factory()->create([
            'price_type' => 'renewal',
            'amount'     => 175.00,
            'start_date'  => '2020-01-02',
            'end_date'    => '2024-03-01 23:59:59',
            'updated_by' => 1
        ]);


        Prices::factory()->create([
            'price_type' => 'eoi',
            'amount'     => 50.00,
            'start_date'  => '2024-01-02',
            'updated_by' => 1
        ]);

        Prices::factory()->create([
            'price_type' => 'submission',
            'amount'     => 500.00,
            'start_date'  => '2024-02-02',
            'updated_by' => 1
        ]);

        Prices::factory()->create([
            'price_type' => 'renewal',
            'amount'     => 200.00,
            'start_date'  => '2024-03-02',
            'updated_by' => 1
        ]);
    }
}
