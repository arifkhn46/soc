<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
     /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();


        $super_admin_role = Role::create(['name' => 'Super Admin']);

        // create demo users
        $admin = \App\User::where('email', 'arifkhn46@gmail.com')->first();
        $admin->assignRole($super_admin_role);
    }
}
