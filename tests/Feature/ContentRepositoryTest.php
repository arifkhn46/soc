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
        $this->signIn();
        $contentRespository = make('App\ContentRepository');
        $response = $this->post(route('content_respository.store', $contentRespository->toArray()));
        $response->assertSessionHas('flash-class', 'is-primary');
    }
}
