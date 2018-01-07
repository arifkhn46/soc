<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateExamTypeTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function an_authenticated_user_can_create_an_exam_type()
    {
        $this->signIn();
        $examType = make('App\ExamType');
        $response = $this->post(route('exam.type.store'), $examType->toArray());
        $this->assertDatabaseHas('exam_types', ['title' => $examType->title]);
    }
}
