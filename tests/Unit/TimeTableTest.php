<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Model\TimeTableTask;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimeTableTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_add_a_task()
    {
        $timeTable = factory(\App\Model\TimeTable::class)->create();

        $task = $timeTable->addTask(make(TimeTableTask::class)->toArray());

        $this->assertCount(1, $timeTable->tasks);
        $this->assertTrue($timeTable->tasks->contains($task));
    }
}
