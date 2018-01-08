<?php

namespace Tests\Feature\Course;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCourseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_course_requires_title()
    {
        $this->createCourse(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_course_title_should_be_minimum_of_four_characters()
    {
        $this->createCourse(['title' => 'CSE'])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_course_requires_exam_type_id()
    {
        $this->createCourse(['exam_type_id' => null])
            ->assertSessionHasErrors('exam_type_id');
    }

    /** @test */
    public function an_authenticated_user_can_create_a_course() 
    {
        $title = "Course";
        $response = $this->createCourse(['title' => $title]);
        $this->assertDatabaseHas('courses', ['title' => $title]);
    }

    /**
     * Create a course.
     */
    public function createCourse($overrides = [])
    {
        $this->withExceptionHandling()->signIn();
        $examType = create('App\ExamType', ['user_id' => auth()->id()]);
        $course = make('App\Course', $overrides + ['exam_type_id' => $examType->id]);
        $response = $this->post(route('courses.store'), $course->toArray());
        return $response;
    }

}
