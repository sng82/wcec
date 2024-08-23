<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'view dashboard']);
        Permission::create(['name' => 'edit own details']);
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage prices']);
        Permission::create(['name' => 'manage admission dates']);
        Permission::create(['name' => 'manage public documents']);
        Permission::create(['name' => 'manage private documents']);
        Permission::create(['name' => 'submit eoi']);
        Permission::create(['name' => 'submit cpd']);
        Permission::create(['name' => 'view applicant help']);


        // create roles and assign created permissions
        Role::create(['name' => 'admin'])
            ->givePermissionTo([
                'view dashboard',
                'edit own details',
                'manage users',
                'manage prices',
                'manage admission dates',
                'manage public documents',
                'manage private documents',
            ]);

        Role::create(['name' => 'applicant'])
            ->givePermissionTo([
                'view dashboard',
                'edit own details',
                'submit eoi',
                'view applicant help',
            ]);

        Role::create(['name' => 'accepted applicant'])
            ->givePermissionTo([
                'view dashboard',
                'edit own details',
            ]);

        Role::create(['name' => 'blocked applicant'])
            ->givePermissionTo([
                'view dashboard',
            ]);

        Role::create(['name' => 'registrant'])
            ->givePermissionTo([
                'view dashboard',
                'edit own details',
                'submit cpd',
            ]);

        Role::create(['name' => 'lapsed registrant'])
            ->givePermissionTo([
                'view dashboard',
                'submit cpd',
            ]);

    }
}
