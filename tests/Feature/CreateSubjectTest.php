<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateSubjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_subject_require_a_title()
    {
        $response = $this->createSubject(['title' => '']);
        $response->assertSessionHasErrors('title');
    }

    /**
     * Create a subject.
     */
    private function createSubject($overrides = [])
    {
        $this->withExceptionHandling()->signInAsAdmin();
        $subject = make('App\Subject', $overrides);
        $response = $this->post(route('admin.subjects.store'), $subject->toArray());
        return $response;
    }
}
