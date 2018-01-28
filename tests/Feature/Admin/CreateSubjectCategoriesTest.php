<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateSubjectCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_subject_category_requires_a_title()
    {
        $this->withExceptionHandling();
        $response = $this->createSubjectCategory(['title' => '']);
        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function an_admin_can_create_a_subject_category()
    {
        $title = 'New Subject Category';
        $response = $this->createSubjectCategory(['title' => $title]);
        $this->assertDatabaseHas('subject_categories', ['title' => $title]);
    }

    /**
     * Create a subject.
     */
    private function createSubjectCategory($overrides = [])
    {
        $this->signInAsAdmin();
        $subjectCategory = make('App\SubjectCategory', $overrides);
        $response = $this->post(route('admin.subject_categories.store'), $subjectCategory->toArray());
        return $response;
    }
}
