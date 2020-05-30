<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Tests\TestCase;

class ManageRolesTest extends TestCase
{
    use RefreshDatabase;

    protected $member, $admin;

    public function setUp(): void
    {
        parent::setUp();

        $this->setupPermissions();

        $this->member = factory(\App\User::class)->create();

        $this->admin = factory(\App\User::class)->create();

        $this->admin->assignRole(getSuperAdminRoleName());

    }

    protected function setupPermissions()
    {
        Permission::findOrCreate('create roles');
        Permission::findOrCreate('edit own posts');
        Permission::findOrCreate('delete any role');

        Role::findOrCreate('instructor')
            ->givePermissionTo(['edit own posts']);

        Role::findOrCreate(getSuperAdminRoleName())
            ->givePermissionTo(['create roles', 'delete any role', 'edit own posts']);

        $this->app->make(PermissionRegistrar::class)->registerPermissions();
    }

    /** @test */
    public function authorized_can_create_a_role()
    {
        $this->signIn($this->admin);
        $role = make(\App\Model\Role::class);

        $this->post(route('role.store'), $role->toArray());

        $this->assertDatabaseHas('roles', ['name' => $role->name]);
    }

    /** @test */
    public function unathorized_member_can_not_create_a_role()
    {
        $role = make(\App\Model\Role::class);

        $this->actingAs($this->member)
            ->post(route('role.create'), $role->toArray());

        $this->assertDatabaseMissing('roles', ['name' => $role->name]);

    }
}
