<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Prices;
use App\Models\SubmissionDate;
//use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //dump(Storage::allFiles('/public/submitted_documents'));

        // Delete old files
        Storage::deleteDirectory('/public/submitted_documents');


        $this->call([
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
        ]);

//        SubmissionDate::factory(3)->create();

        $admission_date = fake()->dateTimeBetween('+4 weeks', '+12 weeks');
        $submission_date = Carbon::parse($admission_date)->subWeeks(2);

        SubmissionDate::factory()->create([
            'admission_date'        => $admission_date,
            'submission_deadline'   => $submission_date,
            'updated_by'            => 1,
        ]);

        for ($i = 0; $i < 3; $i++) {
            $days = fake()->numberBetween(80, 100);
            $admission_date = Carbon::parse($admission_date)->addDays($days);
            while ($admission_date->dayName === 'Saturday' || $admission_date->dayName === 'Sunday' ) {
                $admission_date = Carbon::parse($admission_date)->addDay();
            }
            $submission_date = Carbon::parse($admission_date)->subWeeks(2);

            SubmissionDate::factory()->create([
                'admission_date'        => $admission_date,
                'submission_deadline'   => $submission_date,
                'updated_by'            => 1,
            ]);
        }

        Prices::factory()->create([
            'price_type' => 'registration',
            'amount'     => 30.00,
            'start_date' => '2017-01-01',
            'end_date'   => '2020-01-01 23:59:59',
            'updated_by' => 1
        ]);

        Prices::factory()->create([
            'price_type' => 'submission',
            'amount'     => 350.00,
            'start_date' => '2017-01-01',
            'end_date'   => '2020-01-01 23:59:59',
            'updated_by' => 1
        ]);

        Prices::factory()->create([
            'price_type' => 'renewal',
            'amount'     => 110.00,
            'start_date' => '2017-01-01',
            'end_date'   => '2020-01-01 23:59:59',
            'updated_by' => 1
        ]);


        Prices::factory()->create([
            'price_type' => 'registration',
            'amount'     => 40.00,
            'start_date' => '2020-01-02',
            'end_date'   => '2024-01-01 23:59:59',
            'updated_by' => 1
        ]);

        Prices::factory()->create([
            'price_type' => 'submission',
            'amount'     => 400.00,
            'start_date' => '2020-01-02',
            'end_date'   => '2024-02-01 23:59:59',
            'updated_by' => 1
        ]);

        Prices::factory()->create([
            'price_type' => 'renewal',
            'amount'     => 125.00,
            'start_date' => '2020-01-02',
            'end_date'   => '2024-03-01 23:59:59',
            'updated_by' => 1
        ]);


        Prices::factory()->create([
            'price_type' => 'registration',
            'amount'     => 50.00,
            'start_date' => '2024-01-02',
            'updated_by' => 1
        ]);

        Prices::factory()->create([
            'price_type' => 'submission',
            'amount'     => 500.00,
            'start_date' => '2024-02-02',
            'updated_by' => 1
        ]);

        Prices::factory()->create([
            'price_type' => 'renewal',
            'amount'     => 150.00,
            'start_date' => '2024-03-02',
            'updated_by' => 1
        ]);
    }
}
