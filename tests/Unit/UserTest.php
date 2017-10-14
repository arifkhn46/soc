<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_have_a_role()
    {
        $user = create('App\User');
        $role = create('App\Role');
        $user->attachRole($role->id);
        $this->assertTrue($user->hasRole($role->id));
    }
}
