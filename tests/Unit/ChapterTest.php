<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChapterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_subject()
    {
        $task = create('App\Chapter');

        $this->assertInstanceOf(
            'App\Subject',
            $task->subject
        );
    }
}
