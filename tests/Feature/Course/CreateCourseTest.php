<?php

namespace Tests\Feature\Course;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class publishCourseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_course_requires_title()
    {
        $this->publishCourse(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_course_title_should_be_minimum_of_four_characters()
    {
        $this->publishCourse(['title' => 'CSE'])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_course_requires_exam_type_id()
    {
        $this->publishCourse(['course_type_id' => null])
            ->assertSessionHasErrors('course_type_id');
    }

    /** @test */
    public function an_authenticated_user_can_create_a_course() 
    {
        $title = "Course";
        $response = $this->publishCourse(['title' => $title]);
        $this->assertDatabaseHas('courses', ['title' => $title]);
    }

    /** @test */
    public function an_authenticated_user_can_list_all_courses()
    {
        $title = "Course 1";
        $title2 = "Course 2";
        $this->publishCourse(['title' => $title]);
        $response = $this->get(route('courses.index'));
        $response->assertSee($title);
    }

    /**
     * Create a course.
     */
    public function publishCourse($overrides = [])
    {
        $this->withExceptionHandling()->signIn();
        $courseType = create('App\CourseType', ['user_id' => auth()->id()]);
        $course = make('App\Course', $overrides + ['course_type_id' => $courseType->id]);
        $response = $this->post(route('courses.store'), $course->toArray());
        return $response;
    }
}
