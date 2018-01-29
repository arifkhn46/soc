<?php

namespace Tests\Feature\Teacher;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateSubjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_teacher_can_add_a_subject_to_his_repository()
    {
        $this->signInAsTeacher();
        $subject = make('App\Subject');
        $contentRepository = create('App\ContentRepository');
        $subject = $subject->toArray() + ['content_repository_id' => 1];
        $response = $this->post(route('teacher.subject.store'), $subject);
        $this->assertDatabaseHas('subjects', ['title' => $subject['title']]);
        $this->assertDatabaseHas('content_repository_subject', ['content_repository_id' => $contentRepository->id]);
    }
}
