<?php

namespace Tests\Unit\Teacher;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_should_belongs_to_a_content_repository()
    {
        $subject = create('App\Subject');
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $subject->contentRepositories
        );
    }
}
