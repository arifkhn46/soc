<?php

namespace Tests\Feature\Teacher;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateContent extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_teacher_can_add_a_content_to_his_content_repository()
    {
        $this->signInAsTeacher();
        $contentRespository = create('App\ContentRepository');
        $title = 'Maths';
        $this->createContent(['title' => $title, 'content_repository_id' => $contentRespository->id]);
        $this->assertDatabaseHas('contents', ['title' => $title]);
    }

    private function createContent($overrides = []) {
        $content = make('App\Content', $overrides);
        $response = $this->post(route('teacher.content.store'), $content->toArray());
        return $response;
    }
}
