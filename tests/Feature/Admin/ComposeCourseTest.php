<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ComposeCourseTest extends TestCase
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
        $response = $this->get(route('admin.courses.index'));
        $response->assertSee($title);
    }

    /** @test */
    public function an_authenticated_user_can_update_a_course()
    {
        $title = "Course 1";
        $updatedTitle = "Course 2";
        $this->publishCourse([ 'id' => 1, 'title' => $title]);
        $response = $this->put(route('admin.courses.update', 1), ['title' => $updatedTitle, 'description' => 'Course 2 description']);
        $response->assertSessionHas('flash');
        $this->assertDatabaseHas('courses', ['title' => $updatedTitle]);
    }

    /** @test */
    public function an_authenticated_user_can_destroy_a_course()
    {
        $title = "Course 1";
        $this->publishCourse(['id' => 1, 'title' => $title]);
        $this->assertDatabaseHas('courses', ['title' => $title]);
        $response = $this->delete(route('admin.courses.delete', 1));
        $response->assertSessionHas('flash');
    }

    /**
     * Create a course.
     */
    public function publishCourse($overrides = [])
    {
        $this->withExceptionHandling()->signInAsAdmin();
        $courseType = create('App\CourseType', ['user_id' => auth()->id()]);
        $course = make('App\Course', $overrides + ['course_type_id' => $courseType->id]);
        $response = $this->post(route('admin.courses.store'), $course->toArray());
        return $response;
    }
}
