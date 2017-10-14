<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRoleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Setup necessary things before start executing tests.
     */
    public function setUp()
    {
        parent::setUp();
        $this->signIn();
        $this->role = create('App\Role');
    }

    
    
}
