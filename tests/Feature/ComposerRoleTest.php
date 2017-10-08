<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ComposerRoleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_can_create_a_new_role()
    {
        $this->signIn();
        $role = make('App\Role');
        $response = $this->post('/roles', $role->toArray());
        $this->assertDatabaseHas('roles', ['name' => $role->name]);
    }
}
