<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Response;
use App\Enum\TaskState;
use App\Enum\TaskType;


class ManageTaskTest extends TestCase
{
    use RefreshDatabase;

    protected $permissions = ['create_tasks', 'edit_own_tasks', 'delete_own_tasks', 'view_own_tasks'];

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->setupPermissions();
    }

    /** @test */
    public function a_user_can_fetch_its_non_deleted_tasks()
    {
        // $this->withoutExceptionHandling();

        $this->signIn();
        $owner_id = auth()->id();

        $tasks = create('App\Task', ['owner_id' => $owner_id, 'assignee_id' => $owner_id], 2, 'created');
        $task1 = $tasks->first();
        $task2 = $tasks[1];
        

        $this->json('GET', route('api.task.my_tasks'))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'tasks' => [
                    [
                        'id' => $task1->id,
                        'title' => $task1->title,
                        'owner_id' => $owner_id
                    ]
                ],
                'meta' => [
                    'states' => TaskState::all(), 
                    'types' => TaskType::all(),
                ]
            ])
            ->assertJsonMissing([
                'tasks' => [
                    [
                        'id' => $task2->id,
                        'title' => $task2->title,
                        'owner_id' => $owner_id
                    ]
                ]
            ]);
    }

    /** @test */
    public function unauthenticated_user_can_not_access_task_listing_route()
    {
        $this->json('GET', route('api.task.my_tasks'))
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** @test */
    public function a_user_can_update_his_task_status()
    {   
        $this->signIn();

        $task = create('App\Task', ['owner_id' => auth()->id()] , null, 'created')->first();
        $task_title = $task->title;

        $new_title = "Title Updated";

        $task->title = $new_title;

        $this->patchJson(route('api.task.update', ['task' => $task->id]), $task->toArray())
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'task' => [
                    'title' => $new_title,
                ]
            ]);

        $this->assertDatabaseMissing('tasks', ['title' => $task_title, 'id' => $task->id]);
        $this->assertDatabaseHas('tasks', ['title' => $new_title, 'id' => $task->id]);


    }

    /** @test */
    public function anonymous_user_can_not_update_a_task()
    {
        $task = create('App\Task', [] , null, 'created')->first();

        $this->patchJson(route('api.task.update', ['task' => $task->id]), $task->toArray())
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** @test */
    public function on_task_update_the_state_cannot_be_set_to_created()
    {
        $this->signIn();

        $task = create('App\Task',  ['owner_id' => auth()->id()] , null, 'assigned')->first();

        $task->state = TaskState::created();

        $this->patchJson(route('api.task.update', ['task' => $task->id]), $task->toArray())
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'errors' => ['state' => []]
            ]);

    }

    /** @test */
    public function a_user_can_delete_his_task()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $task = create('App\Task', ['owner_id' => auth()->id()] , null, 'assigned')->first();
        $this->deleteJson(route('api.task.delete', ['task' => $task->id]))
            ->assertStatus(Response::HTTP_OK);
        
        $this->assertSoftDeleted('tasks', [
            'id' => $task->id,
            'title' => $task->title,
        ]);
    }
}
