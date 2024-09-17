<?php

namespace Database\Seeders;

use App\Models\User;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $populate_real_data = false;

        if($populate_real_data) {

            $user = User::create([
                'reg_no' => null,
                'first_name' => 'Sam',
                'last_name' => 'Green',
                'email' => 'sam@asapcomputers.co.uk',
                'password' => Hash::make('asap3434'),
            ]);
            $user->assignRole('admin');
            $user->assignRole('super admin');

            $user = User::create([
                'reg_no'                    => 1,
                'first_name'                => 'Barrie',
                'last_name'                 => 'Torbett',
                'email'                     => 'barrie@renascencegroup.com',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2021-09-20',
                'cpd_last_submitted_at'     => '2023-09-20',
                'renewal_fee_last_paid_at'  => '2023-09-20',
                'registration_expires_at'   => '2024-09-20',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 2,
                'first_name'                => 'Ben Douglas',
                'last_name'                 => 'Jones',
                'email'                     => 'bdj@5pb.co.uk',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2021-09-20',
                'cpd_last_submitted_at'     => '2023-09-20',
                'renewal_fee_last_paid_at'  => '2023-09-20',
                'registration_expires_at'   => '2024-09-20',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 3,
                'first_name'                => 'Lorraine',
                'last_name'                 => 'Larman',
                'email'                     => 'lsafetysolutions@outlook.com',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2021-09-20',
                'cpd_last_submitted_at'     => '2023-09-20',
                'renewal_fee_last_paid_at'  => '2023-09-20',
                'registration_expires_at'   => '2024-09-20',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 4,
                'first_name'                => 'Lynn',
                'last_name'                 => 'Webster',
                'email'                     => 'lynn@lwc-ltd.co.uk',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2021-09-20',
                'cpd_last_submitted_at'     => '2023-09-20',
                'renewal_fee_last_paid_at'  => '2023-09-20',
                'registration_expires_at'   => '2024-09-20',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 5,
                'first_name'                => 'Sandy',
                'last_name'                 => 'Aird',
                'email'                     => 'sandyaird64@gmail.com',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2021-09-20',
                'cpd_last_submitted_at'     => '2023-09-20',
                'renewal_fee_last_paid_at'  => '2023-09-20',
                'registration_expires_at'   => '2024-09-20',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 6,
                'first_name'                => 'Susan',
                'last_name'                 => 'Bartholomew',
                'email'                     => 'soobartholomew@birkingroup.co.uk',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2021-09-20',
                'cpd_last_submitted_at'     => '2023-09-20',
                'renewal_fee_last_paid_at'  => '2023-09-20',
                'registration_expires_at'   => '2024-09-20',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 7,
                'first_name'                => 'Christopher',
                'last_name'                 => 'Broadley',
                'email'                     => 'c.broadley@advancedcleaningservices.co.uk',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2021-09-20',
                'cpd_last_submitted_at'     => '2023-09-20',
                'renewal_fee_last_paid_at'  => '2023-09-20',
                'registration_expires_at'   => '2024-09-20',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 8,
                'first_name'                => 'Anthony',
                'last_name'                 => 'Daly',
                'email'                     => 'tony.daly01@icloud.com',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2021-09-20',
                'cpd_last_submitted_at'     => '2023-09-20',
                'renewal_fee_last_paid_at'  => '2023-09-20',
                'registration_expires_at'   => '2024-09-20',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 9,
                'first_name'                => 'Callum',
                'last_name'                 => 'MacLeod',
                'email'                     => 'callum@amfmltd.com',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2021-09-20',
                'cpd_last_submitted_at'     => '2023-09-20',
                'renewal_fee_last_paid_at'  => '2023-09-20',
                'registration_expires_at'   => '2024-09-20',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 10,
                'first_name'                => 'Callum',
                'last_name'                 => 'MacLeod',
                'email'                     => 'gary@janitorialexpress.co.uk',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2021-09-20',
                'cpd_last_submitted_at'     => '2023-09-20',
                'renewal_fee_last_paid_at'  => '2023-09-20',
                'registration_expires_at'   => '2024-09-20',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 11,
                'first_name'                => 'Denise',
                'last_name'                 => 'Hanson',
                'email'                     => 'denise.hanson@bics.org.uk',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2022-07-05',
                'cpd_last_submitted_at'     => '2024-07-05',
                'renewal_fee_last_paid_at'  => '2024-07-05',
                'registration_expires_at'   => '2025-07-05',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 12,
                'first_name'                => 'Melanie',
                'last_name'                 => 'Richardson',
                'email'                     => 'melanie.richardson@vincifacilities.com',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2022-11-08',
                'cpd_last_submitted_at'     => '2023-11-08',
                'renewal_fee_last_paid_at'  => '2023-11-08',
                'registration_expires_at'   => '2024-11-08',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 13,
                'first_name'                => 'Yvonne',
                'last_name'                 => 'Taylor',
                'email'                     => 'yvonneallisontaylor@outlook.com',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2021-11-03',
                'cpd_last_submitted_at'     => '2023-11-03',
                'renewal_fee_last_paid_at'  => '2023-11-03',
                'registration_expires_at'   => '2024-11-03',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 14,
                'first_name'                => 'Robert',
                'last_name'                 => 'Sutherland',
                'email'                     => 'rob@rams.fm',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2021-11-03',
                'cpd_last_submitted_at'     => '2022-11-03',
                'renewal_fee_last_paid_at'  => '2022-11-03',
                'registration_expires_at'   => '2023-11-03',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('lapsed registrant');

            $user = User::create([
                'reg_no'                    => 15,
                'first_name'                => 'Lauren',
                'last_name'                 => 'Kyle',
                'email'                     => 'laurenkyle3@gmail.com',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2022-05-03',
                'cpd_last_submitted_at'     => '2023-05-03',
                'renewal_fee_last_paid_at'  => '2023-05-03',
                'registration_expires_at'   => '2024-05-03',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('lapsed registrant');

            // NOTE: Not added due to incomplete data
//            $user = User::create([
//                'reg_no'                    => ,
//                'first_name'                => 'Paul',
//                'last_name'                 => 'Pearce',
//                'email'                     => '',
//                'registration_fee_paid'     => 1,
//                'eoi_status'                => 'accepted',
//                'submission_fee_paid'       => 1,
//                'submission_status'         => 'accepted',
//                'registration_pathway'      => 'unknown',
//                'became_registrant_at'      => '2021-09-20',
//                'cpd_last_submitted_at'     => '2023-09-20',
//                'renewal_fee_last_paid_at'  => '2023-09-20',
//                'registration_expires_at'   => '2024-09-20',
//                'password'                  => Hash::make(Str::password(12)),
//            ]);
//            $user->assignRole('registrant');

            // NOTE: Not added due to incomplete data
//            $user = User::create([
//                'reg_no'                    => 17,
//                'first_name'                => 'Terry',
//                'last_name'                 => 'Sullivan',
//                'email'                     => '',
//                'registration_fee_paid'     => 1,
//                'eoi_status'                => 'accepted',
//                'submission_fee_paid'       => 1,
//                'submission_status'         => 'accepted',
//                'registration_pathway'      => 'unknown',
//                'became_registrant_at'      => '',
//                'cpd_last_submitted_at'     => '',
//                'renewal_fee_last_paid_at'  => '',
//                'registration_expires_at'   => '',
//                'password'                  => Hash::make(Str::password(12)),
//            ]);
//            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 18,
                'first_name'                => 'Adam',
                'last_name'                 => 'Cowper Smith',
                'email'                     => 'adam@softservicesolutions.co.uk',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2022-11-08',
                'cpd_last_submitted_at'     => '2023-11-08',
                'renewal_fee_last_paid_at'  => '2023-11-08',
                'registration_expires_at'   => '2024-11-08',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 19,
                'first_name'                => 'Peter',
                'last_name'                 => 'Robb',
                'email'                     => 'probb@nicgroup.co.uk',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2024-02-06',
                'cpd_last_submitted_at'     => '2024-02-06',
                'renewal_fee_last_paid_at'  => '2024-02-06',
                'registration_expires_at'   => '2025-02-06',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            // NOTE: Not added due to incomplete data
//            $user = User::create([
//                'reg_no'                    => 20,
//                'first_name'                => 'Paul',
//                'last_name'                 => 'Castle',
//                'email'                     => '',
//                'registration_fee_paid'     => 1,
//                'eoi_status'                => 'accepted',
//                'submission_fee_paid'       => 1,
//                'submission_status'         => 'accepted',
//                'registration_pathway'      => 'unknown',
//                'became_registrant_at'      => '',
//                'cpd_last_submitted_at'     => '',
//                'renewal_fee_last_paid_at'  => '',
//                'registration_expires_at'   => '',
//                'password'                  => Hash::make(Str::password(12)),
//            ]);
//            $user->assignRole('registrant');


            $user = User::create([
                'reg_no'                    => 21,
                'first_name'                => 'Steve',
                'last_name'                 => 'Trew',
                'email'                     => 'steve@gzcss.co.uk',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2022-05-03',
                'cpd_last_submitted_at'     => '2023-05-03',
                'renewal_fee_last_paid_at'  => '2023-05-03',
                'registration_expires_at'   => '2024-05-03',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('lapsed registrant');

            // NOTE: Not added due to incomplete data
//            $user = User::create([
//                'reg_no'                    => 23,
//                'first_name'                => 'Nicholas',
//                'last_name'                 => 'Rastelli',
//                'email'                     => '',
//                'registration_fee_paid'     => 1,
//                'eoi_status'                => 'accepted',
//                'submission_fee_paid'       => 1,
//                'submission_status'         => 'accepted',
//                'registration_pathway'      => 'unknown',
//                'became_registrant_at'      => '2021-09-20',
//                'cpd_last_submitted_at'     => '2023-09-20',
//                'renewal_fee_last_paid_at'  => '2023-09-20',
//                'registration_expires_at'   => '2024-09-20',
//                'password'                  => Hash::make(Str::password(12)),
//            ]);
//            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 24,
                'first_name'                => 'Joanne',
                'last_name'                 => 'Gilliard',
                'email'                     => 'j.gilliard@jangrohq.net',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2022-05-03',
                'cpd_last_submitted_at'     => '2023-05-03',
                'renewal_fee_last_paid_at'  => '2023-05-03',
                'registration_expires_at'   => '2024-05-03',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('lapsed registrant');

            $user = User::create([
                'reg_no'                    => 25,
                'first_name'                => 'Jay',
                'last_name'                 => 'Adderley',
                'email'                     => 'jay.adderley@ceworld.com',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2024-02-06',
                'cpd_last_submitted_at'     => '2024-02-06',
                'renewal_fee_last_paid_at'  => '2024-02-06',
                'registration_expires_at'   => '2025-02-06',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 26,
                'first_name'                => 'Kevin',
                'last_name'                 => 'Meighan',
                'email'                     => 'kevin.meighan@exclusivecontracts.co.uk',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2022-05-03',
                'cpd_last_submitted_at'     => '2023-05-03',
                'renewal_fee_last_paid_at'  => '2023-05-03',
                'registration_expires_at'   => '2024-05-03',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('lapsed registrant');

            $user = User::create([
                'reg_no'                    => 27,
                'first_name'                => 'Gary',
                'last_name'                 => 'Morgan',
                'email'                     => 'gary@acceleratefacilities.com',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2024-05-06',
                'cpd_last_submitted_at'     => '2024-05-06',
                'renewal_fee_last_paid_at'  => '2024-05-06',
                'registration_expires_at'   => '2025-05-06',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            // NOTE: Not added due to incomplete data
//            $user = User::create([
//                'reg_no'                    => 28,
//                'first_name'                => 'John',
//                'last_name'                 => 'Norris',
//                'email'                     => '',
//                'registration_fee_paid'     => 1,
//                'eoi_status'                => 'accepted',
//                'submission_fee_paid'       => 1,
//                'submission_status'         => 'accepted',
//                'registration_pathway'      => 'unknown',
//                'became_registrant_at'      => '',
//                'cpd_last_submitted_at'     => '',
//                'renewal_fee_last_paid_at'  => '',
//                'registration_expires_at'   => '',
//                'password'                  => Hash::make(Str::password(12)),
//            ]);
//            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 29,
                'first_name'                => 'Louis',
                'last_name'                 => 'Beaumont',
                'email'                     => 'louis@hivecleaning.com',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2022-07-05',
                'cpd_last_submitted_at'     => '2023-07-05',
                'renewal_fee_last_paid_at'  => '2023-07-05',
                'registration_expires_at'   => '2024-07-05',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('lapsed registrant');

            $user = User::create([
                'reg_no'                    => 30,
                'first_name'                => 'Matthew',
                'last_name'                 => 'Dean',
                'email'                     => 'matthew.dean@uk.issworld.com',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2022-11-08',
                'cpd_last_submitted_at'     => '2023-11-08',
                'renewal_fee_last_paid_at'  => '2023-11-08',
                'registration_expires_at'   => '2024-11-08',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            // NOTE: Not added due to incomplete data
//            $user = User::create([
//                'reg_no'                    => ,
//                'first_name'                => 'Lee',
//                'last_name'                 => 'Armitage',
//                'email'                     => '',
//                'registration_fee_paid'     => 1,
//                'eoi_status'                => 'accepted',
//                'submission_fee_paid'       => 1,
//                'submission_status'         => 'accepted',
//                'registration_pathway'      => 'unknown',
//                'became_registrant_at'      => '',
//                'cpd_last_submitted_at'     => '',
//                'renewal_fee_last_paid_at'  => '',
//                'registration_expires_at'   => '',
//                'password'                  => Hash::make(Str::password(12)),
//            ]);
//            $user->assignRole('registrant');

            // NOTE: Not added due to incomplete data
//            $user = User::create([
//                'reg_no'                    => 31,
//                'first_name'                => '',
//                'last_name'                 => '',
//                'email'                     => '',
//                'registration_fee_paid'     => 1,
//                'eoi_status'                => 'accepted',
//                'submission_fee_paid'       => 1,
//                'submission_status'         => 'accepted',
//                'registration_pathway'      => 'unknown',
//                'became_registrant_at'      => '',
//                'cpd_last_submitted_at'     => '',
//                'renewal_fee_last_paid_at'  => '',
//                'registration_expires_at'   => '',
//                'password'                  => Hash::make(Str::password(12)),
//            ]);
//            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 32,
                'first_name'                => 'Paul',
                'last_name'                 => 'Ashton',
                'email'                     => 'paulashton@birkingroup.co.uk',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2022-11-08',
                'cpd_last_submitted_at'     => '2023-11-08',
                'renewal_fee_last_paid_at'  => '2023-11-08',
                'registration_expires_at'   => '2024-11-08',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 33,
                'first_name'                => 'Lara',
                'last_name'                 => 'Wade',
                'email'                     => 'lara.wade@cbre.com',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2023-05-23',
                'cpd_last_submitted_at'     => '2023-05-23',
                'renewal_fee_last_paid_at'  => '2023-05-23',
                'registration_expires_at'   => '2024-05-23',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('lapsed registrant');

            $user = User::create([
                'reg_no'                    => 34,
                'first_name'                => 'Richard',
                'last_name'                 => 'Felton',
                'email'                     => 'rfelton@kindredfm.com',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2024-05-06',
                'cpd_last_submitted_at'     => '2024-05-06',
                'renewal_fee_last_paid_at'  => '2024-05-06',
                'registration_expires_at'   => '2025-05-06',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 35,
                'first_name'                => 'Colm',
                'last_name'                 => 'McGrath',
                'email'                     => 'McGrath-Colm@aramark.ie',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2022-11-08',
                'cpd_last_submitted_at'     => '2023-11-08',
                'renewal_fee_last_paid_at'  => '2023-11-08',
                'registration_expires_at'   => '2024-11-08',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 36,
                'first_name'                => 'Jamieson',
                'last_name'                 => 'Hall',
                'email'                     => 'Jamie.hall@atlasfm.com',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2022-11-08',
                'cpd_last_submitted_at'     => '2023-11-08',
                'renewal_fee_last_paid_at'  => '2023-11-08',
                'registration_expires_at'   => '2024-11-08',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 37,
                'first_name'                => 'James',
                'last_name'                 => 'Melvin',
                'email'                     => 'im.melvin@exclusivecontracts.co.uk',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2023-05-23',
                'cpd_last_submitted_at'     => '2023-05-23',
                'renewal_fee_last_paid_at'  => '2023-05-23',
                'registration_expires_at'   => '2024-05-23',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('lapsed registrant');

            $user = User::create([
                'reg_no'                    => 38,
                'first_name'                => 'Heather',
                'last_name'                 => 'Cracknell',
                'email'                     => 'heather.cracknell@uk.issworld.com',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2023-11-21',
                'cpd_last_submitted_at'     => '2023-11-21',
                'renewal_fee_last_paid_at'  => '2023-11-21',
                'registration_expires_at'   => '2024-11-21',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 39,
                'first_name'                => 'Richard',
                'last_name'                 => 'Rowlands',
                'email'                     => 'r.rowlands@bullough.co.uk',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2023-07-11',
                'cpd_last_submitted_at'     => '2023-07-11',
                'renewal_fee_last_paid_at'  => '2023-07-11',
                'registration_expires_at'   => '2024-07-11',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('lapsed registrant');

            $user = User::create([
                'reg_no'                    => 40,
                'first_name'                => 'Darren',
                'last_name'                 => 'Marston',
                'email'                     => 'dlm@ice-clean.com',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2023-05-23',
                'cpd_last_submitted_at'     => '2023-05-23',
                'renewal_fee_last_paid_at'  => '2023-05-23',
                'registration_expires_at'   => '2024-05-23',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('lapsed registrant');

            $user = User::create([
                'reg_no'                    => 41,
                'first_name'                => 'James',
                'last_name'                 => 'Glass',
                'email'                     => 'jamestglass@gmail.com',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2023-11-21',
                'cpd_last_submitted_at'     => '2023-11-21',
                'renewal_fee_last_paid_at'  => '2023-11-21',
                'registration_expires_at'   => '2024-11-21',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 42,
                'first_name'                => 'Lisa',
                'last_name'                 => 'Holmes',
                'email'                     => 'lholmes@nviro.co.uk',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2024-02-06',
                'cpd_last_submitted_at'     => '2024-02-06',
                'renewal_fee_last_paid_at'  => '2024-02-06',
                'registration_expires_at'   => '2025-02-06',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 43,
                'first_name'                => 'Kelsey',
                'last_name'                 => 'Hargreaves',
                'email'                     => 'kelsey.hargreaves@bics.org.uk',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2024-02-06',
                'cpd_last_submitted_at'     => '2024-02-06',
                'renewal_fee_last_paid_at'  => '2024-02-06',
                'registration_expires_at'   => '2025-02-06',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 44,
                'first_name'                => 'Matthew',
                'last_name'                 => 'Burtionshaw',
                'email'                     => 'mattb@limesupply.com',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2024-02-06',
                'cpd_last_submitted_at'     => '2024-02-06',
                'renewal_fee_last_paid_at'  => '2024-02-06',
                'registration_expires_at'   => '2025-02-06',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            // NOTE: Not added due to incomplete data
//            $user = User::create([
//                'reg_no'                    => 45,
//                'first_name'                => 'Tom',
//                'last_name'                 => 'Richards',
//                'email'                     => 'tom.richards@proceed.solutions',
//                'registration_fee_paid'     => 1,
//                'eoi_status'                => 'accepted',
//                'submission_fee_paid'       => 1,
//                'submission_status'         => 'accepted',
//                'registration_pathway'      => 'unknown',
//                'became_registrant_at'      => '',
//                'cpd_last_submitted_at'     => '',
//                'renewal_fee_last_paid_at'  => '',
//                'registration_expires_at'   => '',
//                'password'                  => Hash::make(Str::password(12)),
//            ]);
//            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 46,
                'first_name'                => 'Matthew',
                'last_name'                 => 'Johnson',
                'email'                     => 'm.johnson@camsupport.co.uk',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2024-05-06',
                'cpd_last_submitted_at'     => '2024-05-06',
                'renewal_fee_last_paid_at'  => '2024-05-06',
                'registration_expires_at'   => '2025-05-06',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 47,
                'first_name'                => 'James',
                'last_name'                 => 'Gates',
                'email'                     => 'james.gates@nexgengroup.uk',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2024-05-06',
                'cpd_last_submitted_at'     => '2024-05-06',
                'renewal_fee_last_paid_at'  => '2024-05-06',
                'registration_expires_at'   => '2025-05-06',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

            $user = User::create([
                'reg_no'                    => 48,
                'first_name'                => 'Gareth',
                'last_name'                 => 'Leverton',
                'email'                     => 'garethleverton@birkingroup.co.uk',
                'registration_fee_paid'     => 1,
                'eoi_status'                => 'accepted',
                'submission_fee_paid'       => 1,
                'submission_status'         => 'accepted',
                'registration_pathway'      => 'unknown',
                'became_registrant_at'      => '2024-05-06',
                'cpd_last_submitted_at'     => '2024-05-06',
                'renewal_fee_last_paid_at'  => '2024-05-06',
                'registration_expires_at'   => '2025-05-06',
                'password'                  => Hash::make(Str::password(12)),
            ]);
            $user->assignRole('registrant');

        } else {
            // Me
            $me = User::factory()->create([
                'reg_no'     => null,
                'first_name' => 'Sam',
                'last_name'  => 'Green',
                'email'      => 'sam@asapcomputers.co.uk',
                'password'   => Hash::make('asap3434'),
            ]);
            $me->assignRole('admin');
            $me->assignRole('super admin');

            $testAdmin = User::factory()->create([
                'first_name' => 'Dan',
                'last_name'  => 'Jones',
                'email'      => 'danjones@test.co.uk',
                'password'   => Hash::make('admin-test'),
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
                'reg_no'     => null,
                'first_name' => 'Test',
                'last_name'  => 'Applicant',
                'email'      => 'software-callback@asapcomputers.co.uk',
                'password'   => Hash::make('asap3434'),
            ]);
            $test_applicant->assignRole('applicant');

            $became_registrant_at   = Carbon::parse(now())->subYears(7)->addDays(27)->format('Y-m-d H:i:s');
            $submission_accepted_at = Carbon::parse($became_registrant_at)->subDays(
                fake()->numberBetween(1, 30)
            )->format('Y-m-d H:i:s');

            $test_registrant = User::factory()->create([
                'first_name'               => 'Ted',
                'last_name'                => 'Hunter',
                'email'                    => 'ted@asapcomputers.co.uk',
                'password'                 => Hash::make('asap3434'),
                'submission_accepted_at'   => $submission_accepted_at,
                'submission_accepted_by'   => 1,
                'eoi_status'               => 'accepted',
                'cpd_last_submitted_at'    => Carbon::parse($became_registrant_at)->addYears(6)->subDays(8)->format(
                        'Y-m-d'
                    ) . ' 13:45:27',
                'renewal_fee_last_paid_at' => Carbon::parse($became_registrant_at)->addYears(6)->subDays(8)->format(
                        'Y-m-d'
                    ) . ' 13:42:18',
                'registration_expires_at'  => Carbon::parse($became_registrant_at)->addYears(7)->format('Y-m-d'),
                'became_registrant_at'     => Carbon::parse($became_registrant_at)->format('Y-m-d'),
                'registration_fee_paid'    => true,
                'registration_pathway'     => fake()->randomElement(['personal', 'standard']),
                'submission_status'        => 'accepted',
                'submission_fee_paid'      => true,
            ]);
            $test_registrant->assignRole('registrant');

            $test_applicant2 = User::factory()->create([
                'reg_no'     => null,
                'first_name' => 'James',
                'last_name'  => 'Smith',
                'email'      => 'jamessmith@test.co.uk',
                'password'   => Hash::make('applicant-test'),
            ]);
            $test_applicant2->assignRole('applicant');

            User::factory()->count(3)->create()->each(function ($user) {
                $user->reg_no = null;
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
                $user->reg_no = null;
                $user->assignRole('applicant');
            });


            // Accepted applicant
            User::factory()->count(4)->create()->each(function ($user) {
                $user->assignRole('accepted applicant');
                $user->submission_interview_at = fake()->dateTimeBetween('-40 days', '-21 days')->format('Y-m-d H:i:s');
                $user->submission_accepted_at  = fake()->dateTimeBetween('-20 days', '-1 days')->format('Y-m-d H:i:s');
                $user->submission_accepted_by  = 1;
                $user->eoi_status              = 'accepted';
                $user->registration_fee_paid   = true;
                $user->submission_status       = 'accepted';
                $user->submission_fee_paid     = true;
                $user->registration_pathway    = fake()->randomElement(['personal', 'standard']);
                $user->save();
            });

            // Blocked applicant
            User::factory()->count(12)->create()->each(function ($user) {
                $user->reg_no = null;
                $user->assignRole('blocked applicant');
                $user->declined_at = fake()->dateTimeBetween('-10 years', '-1 days')->format('Y-m-d H:i:s');
                $user->declined_by = 1;
                $user->save();
            });

            // Active registrant, not expiring anytime soon
            User::factory()->count(47)->create()->each(function ($user) {
                $became_registrant_at   = fake()->dateTimeBetween('-10 years', '-1 days')->format('Y-m-d H:i:s');
                $submission_accepted_at = Carbon::parse($became_registrant_at)->subDays(
                    fake()->numberBetween(1, 30)
                )->format('Y-m-d H:i:s');

                $user->assignRole('registrant');
                $user->submission_accepted_at  = $submission_accepted_at;
                $user->submission_accepted_by  = 1;
                $user->eoi_status              = 'accepted';
                $user->registration_expires_at = fake()->dateTimeBetween('+60 days', '+364 days')->format('Y-m-d');
                $user->became_registrant_at    = Carbon::parse($became_registrant_at)->format('Y-m-d');
                $user->registration_fee_paid   = true;
                $user->registration_pathway    = fake()->randomElement(['personal', 'standard']);
                $user->submission_status       = 'accepted';
                $user->submission_fee_paid     = true;
                $user->save();
            });

            // Active registrant, expiring soon
            User::factory()->count(5)->create()->each(function ($user) {
                $became_registrant_at   = fake()->dateTimeBetween('-10 years', '-1 days')->format('Y-m-d H:i:s');
                $submission_accepted_at = Carbon::parse($became_registrant_at)->subDays(
                    fake()->numberBetween(1, 30)
                )->format('Y-m-d H:i:s');

                $user->assignRole('registrant');
                $user->submission_accepted_at  = $submission_accepted_at;
                $user->submission_accepted_by  = 1;
                $user->eoi_status              = 'accepted';
                $user->registration_pathway    = fake()->randomElement(['personal', 'standard']);
                $user->registration_expires_at = fake()->dateTimeBetween('+1 days', '+30 days')->format('Y-m-d');
                $user->became_registrant_at    = Carbon::parse($became_registrant_at)->format('Y-m-d');
                $user->registration_fee_paid   = true;
                $user->submission_status       = 'accepted';
                $user->submission_fee_paid     = true;
                $user->save();
            });

            // Active registrants, just passed expiry date
            User::factory()->count(5)->create()->each(function ($user) {
                $became_registrant_at   = fake()->dateTimeBetween('-10 years', '-1 days')->format('Y-m-d H:i:s');
                $submission_accepted_at = Carbon::parse($became_registrant_at)->subDays(
                    fake()->numberBetween(1, 30)
                )->format('Y-m-d H:i:s');

                $user->assignRole('registrant');
                $user->submission_accepted_at  = $submission_accepted_at;
                $user->submission_accepted_by  = 1;
                $user->eoi_status              = 'accepted';
                $user->registration_pathway    = fake()->randomElement(['personal', 'standard']);
                $user->registration_expires_at = fake()->dateTimeBetween('-60 days', '-1 days')->format('Y-m-d');
                $user->became_registrant_at    = Carbon::parse($became_registrant_at)->format('Y-m-d');
                $user->registration_fee_paid   = true;
                $user->submission_status       = 'accepted';
                $user->submission_fee_paid     = true;
                $user->save();
            });

            // Lapsed registrant
            User::factory()->count(5)->create()->each(function ($user) {
                $became_registrant_at   = fake()->dateTimeBetween('-18 years', '-11 years')->format('Y-m-d H:i:s');
                $submission_accepted_at = Carbon::parse($became_registrant_at)->subDays(
                    fake()->numberBetween(1, 30)
                )->format('Y-m-d H:i:s');

                $user->assignRole('lapsed registrant');
                $user->submission_accepted_at  = $submission_accepted_at;
                $user->submission_accepted_by  = 1;
                $user->eoi_status              = 'accepted';
                $user->registration_pathway    = fake()->randomElement(['personal', 'standard']);
                $user->registration_expires_at = fake()->dateTimeBetween('-10 years', '-1 days')->format('Y-m-d');
                $user->became_registrant_at    = Carbon::parse($became_registrant_at)->format('Y-m-d');
                $user->registration_fee_paid   = true;
                $user->submission_status       = 'accepted';
                $user->submission_fee_paid     = true;
                $user->save();
            });
        }
    }
}
