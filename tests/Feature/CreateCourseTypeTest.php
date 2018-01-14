<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCourseTypeTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function an_authenticated_user_can_create_a_course_type()
    {
        $this->signIn();
        $courseType = make('App\CourseType');
        $response = $this->post(route('course.types.store'), $courseType->toArray());
        $this->assertDatabaseHas('course_types', ['title' => $courseType->title]);
    }
}
