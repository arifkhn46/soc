<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ComposerRoleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Setup necessary things before start executing tests.
     */
    public function setUp()
    {
        parent::setUp();
        $this->signInAsAdmin();
        $this->role = create('App\Role');
    }


    /** @test */
    public function admin_user_can_create_a_new_role()
    {
        $createRole = $this->createRole();
        $reponse = $createRole['response'];
        $role = $createRole['role'];
        $this->assertDatabaseHas('roles', ['name' => $role->name]);
    }

    /** @test */
    public function  admin_user_can_view_all_roles()
    {
        $this->get(route('roles.list'))->assertSee($this->role->name);    
    }

    /**
     * @todo Need to refer the documentation.
     */

    /** @test */
    public function a_role_requires_name()
    {
        $createRole = $this->createRole(['name' => null]);
        $createRole['response']->assertSessionHasErrors('name');
    }

    /**
     * Create a role by making a post call.
     */
    protected function createRole($overrides = [])
    {
        $this->withExceptionHandling();
        $role = make('App\Role', $overrides);
        $response = $this->post(route('roles.store'), $role->toArray());
        return array('response' => $response, 'role' => $role);
    }

}
