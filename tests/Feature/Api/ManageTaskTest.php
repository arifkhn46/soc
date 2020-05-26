<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Response;

class ManageTaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_fetch_its_created_tasks()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $owner_id = auth()->id();
        
        $task = create('App\Task', ['owner_id' => $owner_id, 'assignee_id' => $owner_id])->first();

        $this->json('GET', route('api.task.my_tasks'))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'tasks' => [
                    [
                        'id' => $task->id,
                        'title' => $task->title,
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
      
    }
}
