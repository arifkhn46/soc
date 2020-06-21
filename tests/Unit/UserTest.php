<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_have_a_content_repository()
    {
        $user = create('App\User');
        $contentRepository = create('App\ContentRepository', ['user_id' => $user->id]);
        $this->assertEquals($user->contentRepositories()->first()->id, $contentRepository->id);
    }

    /** @test */
    public function it_can_have_tasks()
    {
        $user = create('App\User');

        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $user->tasks
        );
    }

    /** @test */
    public function it_can_have_time_tables()
    {
        $user = create('App\User');

        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $user->timeTables
        );
    }
}
