<?php

namespace Tests;

use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;
use App\Model\Permission;
use App\Model\Role;
use Spatie\Permission\PermissionRegistrar;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $permissions = [];

    protected function signIn($user = null, $role = 'User')
    {
        $user = $user ?: create('App\User');
        Sanctum::actingAs(
            $user,
            ['*']
        );

        $this->setupPermissions();

        if ($role && $this->permissions) {
            $user->assignRole($role);
        }

        return $this;
    }

    protected function signInAsAdmin()
    {
        $this->permissions = ['create_tasks'];
        return $this->signIn(null, \getSuperAdminRoleName());
    }


    protected function signInAsTeacher($overrides = [])
    {
        if(empty($overrides['email'])) {
            $overrides['email'] = 'jyoti.raman2013@gmail.com';
        }
        $teacher = create('App\User', $overrides);
        $this->actingAs($teacher);
        return $teacher;
    }


    /**
     * Json Post helper
     */
    public function jsonPost(array $data, string $route, $headers = [])
    {
        if ($headers) {
            $this->withHeaders($headers);
        }

        return $this->json('POST', $route, $data);

    }

    protected function setupPermissions()
    {
        $role = Role::firstOrCreate(['name' => 'User']);
        Role::findOrCreate(getSuperAdminRoleName());

        if ($this->permissions) {
            $permissions = Permission::defaultPermissions();

            foreach ($permissions as $perms) {
                Permission::firstOrCreate(['name' => $perms]);
            }
            
            $role->givePermissionTo($this->permissions);
        }

        $this->app->make(PermissionRegistrar::class)->registerPermissions();
    }

}
