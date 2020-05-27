<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Response;
use App\Enum\TaskState;

class CreateTaskTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->createTaskRoute = route('api.task.create');
    }

    /** @test */
    public function a_task_requires_a_title()
    {
        // $this->withoutExceptionHandling();
        $this->signIn();

        $this->jsonPost([], $this->createTaskRoute)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'errors' => ['title' => []]
            ]);

        $task = $this->makeATask();

        $this->jsonPost($task->toArray(),$this->createTaskRoute)
            ->assertStatus(Response::HTTP_CREATED);
    }

    /** @test */
    public function a_task_requires_a_description()
    {
        $this->signIn();

        $task = $this->makeATask(['description' => '']);

        $this->jsonPost($task->toArray(), $this->createTaskRoute)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'errors' => ['description' => []]
            ]);

        $task = $this->makeATask();

        $this->jsonPost($task->toArray(),$this->createTaskRoute)
            ->assertStatus(Response::HTTP_CREATED);

    }

    /** @test */
    public function a_task_requires_a_type_of_type_integer()
    {
        $this->signIn();

        $task = $this->makeATask(['type' => '']);

        $this->jsonPost($task->toArray(), $this->createTaskRoute)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'errors' => ['type' => []]
            ]);

        $task->type = 'string';
        $this->jsonPost($task->toArray(), $this->createTaskRoute)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'errors' => ['type' => []]
            ]);

        $task = $this->makeATask();

        $this->jsonPost($task->toArray(),$this->createTaskRoute)
            ->assertStatus(Response::HTTP_CREATED);

    }

    /** @test */
    public function a_task_requires_a_subject()
    {
        $this->signIn();

        $task = $this->makeATask(['subject_id' => '']);

        $this->jsonPost($task->toArray(), $this->createTaskRoute)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'errors' => ['subject_id' => []]
            ]);

        $task2 = $this->makeATask(['subject_id' => 9999]);

        $this->jsonPost($task2->toArray(), $this->createTaskRoute)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'errors' => ['subject_id' => []]
            ]);

        $task = $this->makeATask();

        $this->jsonPost($task->toArray(),$this->createTaskRoute)
            ->assertStatus(Response::HTTP_CREATED);

    }

    /** @test */
    // public function a_task_requires_a_state_of_type_integer()
    // {
    //     $this->signIn();

    //     $task = make('App\Task');

    //     $this->jsonPost($task->toArray(), $this->createTaskRoute)
    //         ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
    //         ->assertJson([
    //             'errors' => ['state' => []]
    //         ]);

    //     $task->state = 'string';

    //     $this->jsonPost($task->toArray(), $this->createTaskRoute)
    //         ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
    //         ->assertJson([
    //             'errors' => ['state' => []]
    //         ]);


    //     $task = $this->makeATask();

    //     $this->jsonPost($task->toArray(),$this->createTaskRoute)
    //         ->assertStatus(Response::HTTP_CREATED);

    // }



    /** @test */
    public function a_task_requires_a_valid_start_date_time()
    {
        $this->signIn();

        $task1 = $this->makeATask(['start_at' => '']);

        $this->jsonPost($task1->toArray(), $this->createTaskRoute)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'errors' => ['start_at' => []]
            ]);

        $task2 = $this->makeATask(['start_at' => 'some_invalid_date']);

        $this->jsonPost($task2->toArray(), $this->createTaskRoute)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'errors' => ['start_at' => []]
            ]);


        $task3 = $this->makeATask();

        $this->jsonPost($task3->toArray(),$this->createTaskRoute)
            ->assertStatus(Response::HTTP_CREATED);

    }


    /** @test */
    public function a_task_requires_a_valid_end_date_time()
    {
        // $this->withoutExceptionHandling();
        $this->signIn();

        $task1 = $this->makeATask(['end_at' => '']);

        $this->jsonPost($task1->toArray(), $this->createTaskRoute)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'errors' => ['end_at' => []]
            ]);

        $task2 = $this->makeATask(['end_at' => 'some_invalid_date']);

        $this->jsonPost($task2->toArray(), $this->createTaskRoute)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'errors' => ['end_at' => []]
            ]);


        $task3 = $this->makeATask();

        $this->jsonPost($task3->toArray(),$this->createTaskRoute)
            ->assertStatus(Response::HTTP_CREATED);

    }

    /** @test */
    public function task_end_date_time_must_be_greater_than_start_date_time()
    {
        $this->signIn();

        $startingDate = new \Carbon\Carbon();
        $task = $this->makeATask([
            'start_at' => $startingDate->toDateTimeString(),
            'end_at' => $startingDate->toDateTimeString(),
        ]);

        $this->jsonPost($task->toArray(), $this->createTaskRoute)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'errors' => ['end_at' => []]
            ]);

        $task2 = $this->makeATask();

        $this->jsonPost($task2->toArray(), $this->createTaskRoute)
            ->assertStatus(Response::HTTP_CREATED);

    }


    /** @test */
    public function a_task_requires_a_chapter_id()
    {
        $this->signIn();

        $task = $this->makeATask(['chapter_id' => '']);

        $this->jsonPost($task->toArray(), $this->createTaskRoute)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'errors' => ['chapter_id' => []]
            ]);

        $task2 = $this->makeATask(['chapter_id' => 9999]);

        $this->jsonPost($task2->toArray(), $this->createTaskRoute)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'errors' => ['chapter_id' => []]
            ]);

        $task3 = $this->makeATask();
        $this->jsonPost($task3->toArray(), $this->createTaskRoute)
            ->assertStatus(Response::HTTP_CREATED);

    }

    /** @test */
    public function a_task_chapter_must_belongs_to_the_task_subject()
    {
        // $this->withoutExceptionHandling();
        $this->signIn();

        $task1 = $this->makeATask(['chapter_id' => 2]);

        $this->jsonPost($task1->toArray(), $this->createTaskRoute)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'errors' => ['chapter_id' => []]
            ]);

        $task2 = $this->makeATask();
        $this->jsonPost($task2->toArray(), $this->createTaskRoute)
            ->assertStatus(Response::HTTP_CREATED);
    }

    /** @test */
    public function a_task_may_have_a_assignee()
    {
        // $this->withoutExceptionHandling();
        $this->signIn();

        $task1 = $this->makeATask(['assignee_id' => '']);

        $this->jsonPost($task1->toArray(), $this->createTaskRoute)
            ->assertStatus(Response::HTTP_CREATED);

        $task2 = $this->makeATask(['assignee_id' => 'invalid_user_id']);

        $this->jsonPost($task2->toArray(), $this->createTaskRoute)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'errors' => ['assignee_id' => []]
            ]);

        $task3 = $this->makeATask(['assingee_id' => create(\App\User::class)->id]);

        $this->jsonPost($task3->toArray(), $this->createTaskRoute)
            ->assertStatus(Response::HTTP_CREATED);
    }

    /** @test */
    public function authenticated_user_can_create_a_task()
    {
        // $this->withoutExceptionHandling();

        $this->signIn();

        $task = $this->makeATask();
        
        $this->jsonPost($task->toArray(),$this->createTaskRoute)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson([
                'task' => [
                    'title' => $task->title,
                ]
            ]);

        $this->assertDatabaseHas('tasks', ['title' => $task->title]);
    }

    /** @test */
    public function the_state_must_be_set_to_created_on_creating_a_task()
    {
        $task_state_created = 1;

        $this->signIn();

        $task = $this->makeATask();
        
        $this->jsonPost($task->toArray(),$this->createTaskRoute)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson([
                'task' => [
                    'title' => $task->title,
                    'state' => TaskState::getName($task_state_created),
                ]
            ]);

        $this->assertDatabaseHas('tasks', ['title' => $task->title, 'state' => $task_state_created]);
    }

    /** @test */
    public function authenticated_considered_as_assignee_if_assignee_id_is_not_given()
    {
        $this->signIn();

        $task = $this->makeATask(['assignee_id' => '']);

        $this->jsonPost($task->toArray(),$this->createTaskRoute)
            ->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('tasks', ['title' => $task->title, 'assignee_id' => auth()->id()]);
      
    }

    /** @test */
    public function unauthenticated_user_can_not_create_a_task()
    {
        $task = $this->makeATask();

        $this->jsonPost($task->toArray(),$this->createTaskRoute)
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    private function makeATask(array $attributes = [], string $state = '')
    {
        return make('App\Task', $attributes, null, $state);
    }
}
