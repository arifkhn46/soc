<?php

namespace Tests\Feature\Api;

use Carbon\Carbon;
use Tests\TestCase;
use App\Model\TimeTable;
use App\Model\TimeTableTask;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimeTableTasksTest extends TestCase
{
    use RefreshDatabase;

     /** @test */
    public function a_time_table_task_requires_a_valid_day()
    {
        $timeTable = create(TimeTable::class)->first();
        $timeTableTask = make(TimeTableTask::class, ['day' => '']);

        $this->jsonPost($timeTableTask->toArray(), route('api.time_table.add_task', ['time_table' => $timeTable->id]))
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'errors' => ['day' => []]
        ]);

        $timeTableTask = make(TimeTableTask::class, ['day' => -1]);
        $this->jsonPost($timeTableTask->toArray(), route('api.time_table.add_task', ['time_table' => $timeTable->id]))
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'errors' => ['day' => []]
        ]);


        // The day should not be between start date and the end date of the time table
        $timeTableTask = make(TimeTableTask::class, ['day' => -1]);
        $this->jsonPost($timeTableTask->toArray(), route('api.time_table.add_task', ['time_table' => $timeTable->id]))
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'errors' => ['day' => []]
        ]);

        $timeTableTask = make(TimeTableTask::class);
        $this->jsonPost($timeTableTask->toArray(), route('api.time_table.add_task', ['time_table' => $timeTable->id]))
        ->assertStatus(Response::HTTP_OK);

    }

    /** @test */
    public function a_time_table_task_requires_a_valid_start_time()
    {

        $timeTable = create(TimeTable::class)->first();
        $timeTableTask = make(TimeTableTask::class, ['start_time' => '']);

        $this->jsonPost($timeTableTask->toArray(), route('api.time_table.add_task', ['time_table' => $timeTable->id]))
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'errors' => ['start_time' => []]
        ]);


        $timeTableTask = make(TimeTableTask::class, ['start_time' => 'invalid']);

        $this->jsonPost($timeTableTask->toArray(), route('api.time_table.add_task', ['time_table' => $timeTable->id]))
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'errors' => ['start_time' => []]
        ]);


        $timeTableTask = make(TimeTableTask::class);
        $this->jsonPost($timeTableTask->toArray(), route('api.time_table.add_task', ['time_table' => $timeTable->id]))
        ->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function a_time_table_task_requires_a_valid_end_time()
    {

        $timeTable = create(TimeTable::class)->first();
        $timeTableTask = make(TimeTableTask::class, ['end_time' => '']);

        $this->jsonPost($timeTableTask->toArray(), route('api.time_table.add_task', ['time_table' => $timeTable->id]))
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'errors' => ['end_time' => []]
        ]);

        $timeTableTask = make(TimeTableTask::class, ['end_time' => 'invalid']);
        $this->jsonPost($timeTableTask->toArray(), route('api.time_table.add_task', ['time_table' => $timeTable->id]))
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'errors' => ['end_time' => []]
        ]);


        $timeTableTask = make(TimeTableTask::class);
        $this->jsonPost($timeTableTask->toArray(), route('api.time_table.add_task', ['time_table' => $timeTable->id]))
        ->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function a_task_table_task_timing_should_not_overlap()
    {
        // $this->withoutExceptionHandling();

        $timeTable = create(TimeTable::class)->first();
        $timeTableTask = make(TimeTableTask::class);

        $this->jsonPost($timeTableTask->toArray(), route('api.time_table.add_task', ['time_table' => $timeTable->id]))
        ->assertStatus(Response::HTTP_OK);

        $timeTableTask2 = make(TimeTableTask::class, ['start_time' => '06:30 AM', 'end_time' => '07:30 AM']);
        $this->jsonPost(
                $timeTableTask2->toArray(),
                route('api.time_table.add_task', ['time_table' => $timeTable->id])
            )
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'errors' => ['end_time' => []]
            ]);

        $this->assertDatabaseHas('time_table_tasks', ['start_time' => $timeTable->getTaskTiming($timeTableTask->day, $timeTableTask->start_time)]);
        $this->assertDatabaseMissing('time_table_tasks' , ['start_time' => $timeTable->getTaskTiming($timeTableTask2->day, $timeTableTask2->start_time)]);
    }


    /** @test */
    public function a_user_can_update_his_time_table_task_status()
    {
        $this->signIn();

        $timeTable = auth()->user()->timeTables()->create(make(TimeTable::class)->toArray());

        $task = $timeTable->addTask(make(TimeTableTask::class)->toArray());

        $this->assertFalse($task->completed);

        $this->patchJson(route('api.time_table_task.update', ['task' => $task->id]), [
                'completed' => true,
                'comment' => 'Task Completed',
            ])->assertStatus(Response::HTTP_OK);

        $task->refresh();

        $this->assertTrue($task->completed);

    }

}
