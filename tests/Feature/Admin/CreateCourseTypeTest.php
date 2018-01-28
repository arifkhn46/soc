<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCourseTypeTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function an_admin_user_can_create_a_course_type()
    {
        $this->signInAsAdmin();
        $courseType = make('App\CourseType');
        $response = $this->post(route('admin.course_types.store'), $courseType->toArray());
        $this->assertDatabaseHas('course_types', ['title' => $courseType->title]);
    }
}
