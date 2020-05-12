<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_many_chapters()
    {
        $subject = create('App\Subject');

        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $subject->chapters
        );
    }


    /** @test */
    public function it_has_many_tasks()
    {
        $subject = create('App\Subject');

        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $subject->tasks
        );
    }
}
