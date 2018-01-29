<?php

namespace Tests\Feature\Teacher;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTopicTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_teacher_can_create_a_topic()
    {
        $this->signInAsTeacher();
        $topic = make('App\Topic');
        $this->post(route('teacher.topics.store'), $topic->toArray());
        $this->assertDatabaseHas('topics', ['title' => $topic->title]);
    }
}
