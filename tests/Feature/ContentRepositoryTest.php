<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContentRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_teacher_can_create_a_content_respository()
    {
        $this->signInAsTeacher();
        $contentRespository = make('App\ContentRepository');
        $response = $this->post(route('teacher.content_repository.store'), $contentRespository->toArray());
        $response->assertSessionHas('flash-class', 'is-primary');
    }

    /** @test */
    public function a_teacher_can_list_his_repositories()
    {
        $this->signInAsTeacher();
        $title = 'My content Repository';
        $contentRespository_1 = create('App\ContentRepository', ['title' => $title, 'user_id' => auth()->id()]);
        $user2 = create('App\User');
        $title2 = 'Someone else repository';
        $contentRespository_1 = create('App\ContentRepository', ['title' => $title2, 'user_id' => $user2->id]);
        $response = $this->get(route('teacher.content_repository.list'));
        $response->assertSee($title);
        $response->assertDontSee($title2);
    }
    
}
