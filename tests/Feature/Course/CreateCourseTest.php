<?php

namespace Tests\Feature\Course;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCourseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_can_create_a_course() 
    {
        $this->signIn();
        $examType = create('App\ExamType', ['user_id' => auth()->id()]);
        $course = make('App\Course', ['exam_type_id' => $examType->id]);
        $response = $this->post(route('courses.store'), $course->toArray());
        $this->assertDatabaseHas('courses', ['title' => $course->title]);
    }
}
