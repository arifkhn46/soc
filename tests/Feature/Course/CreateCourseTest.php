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
        $course = make('App\Course');
        $response = $this->post(route('courses.create'), $course->toArray());
        $this->assertDatabaseHas('courses', ['title' => $course->title]);
    }
}
