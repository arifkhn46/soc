<?php

namespace Tests\Feature\Course;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCourseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_new_course_can_be_created() 
    {
        $this->signIn();
        $course = make('App\Course');
        $response = $this->post(route('courses.store'), $course->toArray());
        $this->assertDatabaseHas('courses', ['title' => $course->title]);
    }
}
