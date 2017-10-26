<?php

namespace Tests;

use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function signIn($user = null)
    {
        $user = $user ?: create('App\User');
        $this->actingAs($user);
        return $this;
    }

    protected function signInAsAdmin()
    {
        $role = create('App\Role', ['name' => 'admin']); 
        $admin = create('App\User', ['id' => 1]);
        $admin->attachRole($role->id);
        $this->actingAs($admin);
        return $this;
    }
}
