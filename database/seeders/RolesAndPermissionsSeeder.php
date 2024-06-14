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
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'view prices']);
        Permission::create(['name' => 'view submission dates']);
        Permission::create(['name' => 'view admin dashboard']);

        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'edit roles']);
        Permission::create(['name' => 'edit permissions']);
        Permission::create(['name' => 'edit prices']);
        Permission::create(['name' => 'edit submission dates']);

        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'delete roles']);
        Permission::create(['name' => 'delete permissions']);
        Permission::create(['name' => 'delete prices']);
        Permission::create(['name' => 'delete submission dates']);


        // create roles and assign created permissions

        // this can be done as separate statements
        Role::create(['name' => 'admin'])
            ->givePermissionTo([
                'view users',
                'view roles',
                'view permissions',
                'view prices',
                'view submission dates',
                'view admin dashboard',
                'edit users',
                'edit roles',
                'edit permissions',
                'edit prices',
                'edit submission dates',
                'delete users',
                'delete roles',
                'delete permissions',
                'delete prices',
                'delete submission dates',
            ]);

//        Role::create(['name' => 'new applicant']);
        Role::create(['name' => 'applicant']);
        Role::create(['name' => 'accepted applicant']);
        Role::create(['name' => 'blocked applicant']);
        Role::create(['name' => 'member']);
        Role::create(['name' => 'lapsed member']);

    }
}
