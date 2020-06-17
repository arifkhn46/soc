<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Tests\TestCase;
use Illuminate\Http\Response;

class ManageRolesTest extends TestCase
{
    use RefreshDatabase;

    protected $permissions = ['create_tasks'];

    public function setUp(): void
    {
        parent::setUp();

        $this->setupPermissions();

    }

    /** @test */
    public function authorized_can_create_a_role()
    {
        $this->signIn(null, getSuperAdminRoleName());
        $role = make(\App\Model\Role::class);

        $this->post(route('role.store'), $role->toArray());

        $this->assertDatabaseHas('roles', ['name' => $role->name]);

        $role2 = make(\App\Model\Role::class);
        
        $this->postJson(route('role.store'), $role2->toArray())
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson([
                'role' => [
                    'name' => $role2->name
                ]
            ]);
    }

    /** @test */
    public function unathorized_member_can_not_create_a_role()
    {
        $role = make(\App\Model\Role::class);
        $this->signIn();
        $this->post(route('role.create'), $role->toArray());

        $this->assertDatabaseMissing('roles', ['name' => $role->name]);

    }

    /** @test */
    public function admin_can_assign_permissions_a_role()
    {
        $role = create(\App\Model\Role::class)->first();
        
        $this->signIn(null, \getSuperAdminRoleName());

        $data = [
            'permissions' => [
                'create_tasks',
                'view_own_tasks'
            ]
        ];

        $this->putJson(route('roles.assign_permissions', ['role' => $role->id]), $data)
            ->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function unathorized_member_can_not_assign_permissions()
    {
        $role = create(\App\Model\Role::class)->first();
        
        $this->signIn();

        $data = [
            'permissions' => [
                'edit own posts',
                'create posts'
            ]
        ];
        
        $this->putJson(route('roles.assign_permissions', ['role' => $role->id]), $data)
            ->assertStatus(Response::HTTP_FORBIDDEN);

    }
}
