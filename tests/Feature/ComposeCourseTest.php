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
    function setUp()
    {
        parent::setUp();
    }

    /** @test */
    function course_title_is_required()
    {
        $response = $this->createCourse(['title' => '']);
        $response->assertSessionHasErrors('title');
    }


    /** @test */
    function course_description_is_required()
    {
        $response = $this->createCourse(['description' => '']);
        $response->assertSessionHasErrors('description');
    }

    /** @test */
    function course_title_should_have_at_least_4_characters()
    {
        $response = $this->createCourse(['title' => 'adg']);
        $response->assertSessionHasErrors('title');
    }

    /** @test */
    function admin_can_create_a_course()
    {
        $this->signInAsAdmin();
        $course = make('App\Course');
        $this->post(route('course.store'), $course->toArray());    
        $this->assertDatabaseHas('courses', [ 'title' => $course->title]);
    }

    /** @test */
    function a_non_admin_user_can_not_create_a_course()
    {
        $this->withExceptionHandling();
        $user = create('App\User', ['id' => 2]);
        $this->signIn();
        $course = make('App\Course');
        $response = $this->post(route('course.store'), $course->toArray());
        $response->assertRedirect('/');
    }

    /** @test */
    function admin_can_delete_a_course()
    {
        $this->signInAsAdmin();
        $this->assertDatabaseMissing('courses', [ 'id' => 1]);
    }

    /**
     * Helper function to create a course.
     *
     * @return void
     */
    function createCourse($overrides = [])
    {
        $this->signInAsAdmin();
        $course = make('App\Course', $overrides);
        return $this->post(route('course.store'), $course->toArray());
    }

    
}
