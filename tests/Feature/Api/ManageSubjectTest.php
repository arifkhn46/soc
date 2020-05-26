<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Response;

class ManageSubjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_can_get_the_subjects_list()
    {
        $this->json('GET', route('api.subject.list'))
            ->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->signIn();
    
        $subject1 = create('App\Subject', [], 1)->first(); 

        $this->json('GET', route('api.subject.list'))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'data' => [
                    [
                        'id' => $subject1->id,
                        'name' => $subject1->name
                    ]
                ],
                'meta' => [
                    'task_types' => []
                ]
            ]);
        
    }

    /** @test */
    public function an_authenticated_user_can_fetch_chapters_of_a_give_subject_id()
    {        
        $this->json('GET', route('api.subject.chapters', ['subject' => 1]))
            ->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->withoutExceptionHandling();

        $this->signIn();
        $subject1 = create('App\Subject', [], 1)->first(); 

        $chapter1 = create('App\Chapter', ['subject_id' => $subject1->id], 5)->first();

        $this->json('GET', route('api.subject.chapters', ['subject' => $subject1->id]))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'data' => [
                    [
                        'id' => $chapter1->id,
                        'subject_id' => $subject1->id
                    ]
                ]
            ]);
      
    }
}
