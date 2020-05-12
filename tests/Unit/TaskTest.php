<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_subject()
    {
        $task = factory('App\Task')->states('created')->create();

        $this->assertInstanceOf(
            'App\Subject',
            $task->subject
        );
    }


    /** @test */
    public function it_blongs_to_a_chapter()
    {
        $task = factory('App\Task')->states('created')->create();

        $this->assertInstanceOf(
            'App\Chapter',
            $task->chapter
        );
    }

    /** @test */
    public function it_has_a_owner()
    {
        $task = factory('App\Task')->states('created')->create();
        $this->assertInstanceOf(
            'App\User',
            $task->owner
        );
    }

    /** @test */
    public function it_has_a_assignee()
    {
        $task = factory('App\Task')->states('created')->create(['assignee_id' => create(\App\User::class)->id]);
        $this->assertInstanceOf(
            'App\User',
            $task->assignee
        );
    }
}
