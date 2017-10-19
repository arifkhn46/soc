<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ComposeCourseTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Setup necessary things before start executing tests.
     */
    public function setUp()
    {
        parent::setUp();
        $this->signInAsAdmin();
    }

    /** @test */
    public function admin_can_create_a_course()
    {
        

    }
}
