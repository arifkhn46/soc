<?php

use Illuminate\Database\Seeder;
use App\Model\Permission;
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
        config(['auth.defaults.guard' => 'sanctum']);
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();


        $super_admin_role = getSuperAdminRoleName();

        // Seed the default permissions
        $permissions = Permission::defaultPermissions();
        foreach ($permissions as $perms) {
            Permission::firstOrCreate(['name' => $perms]);
        }

        $this->command->info('Default Permissions added.');

        // Confirm roles needed
        if ($this->command->confirm("Create Roles for user, default is $super_admin_role  and Student? [y|N]", true)) {

            // Ask for roles from input
            $input_roles = $this->command->ask('Enter roles in comma separate format.', "$super_admin_role,Student");

            // Explode roles
            $roles_array = explode(',', $input_roles);

            // add roles
            foreach($roles_array as $role_to_create) {
                $role = Role::firstOrCreate(['name' => trim($role_to_create)]);
                if( $role->name == getSuperAdminRoleName() ) {
                    // assign all permissions
                    $role->syncPermissions(Permission::all());
                    $this->command->info('Admin granted all the permissions');
                } else {
                    // for others by default only read access
                    $role->syncPermissions(Permission::where('name', 'LIKE', 'view_%')->get());
                }

                // create one user for each role
                $this->createUser($role);
            }

            $this->command->info('Roles ' . $input_roles . ' added successfully');

        } else {
            Role::firstOrCreate(['name' => 'Student']);
            $this->command->info('Added only default user role.');
        }

        $user = factory(\App\User::class)->create();
        // now lets seed some posts for demo
        factory(\App\Task::class, 20)->states('assigned')->create(['assignee_id' => $user->id]);
        $this->command->info('Some Posts data seeded.');
        $this->command->warn('All done :)');
    }

    /**
     * Create a user with given role
     *
     * @param $role
     */
    private function createUser($role) {
    
        if($role->name == getSuperAdminRoleName()) {
            $user = \App\User::where('email', 'arifkhn46@gmail.com')->first();
        }else {
            $user = factory(\App\User::class)->create();
        }

        $user->assignRole($role->name);
    }
}
