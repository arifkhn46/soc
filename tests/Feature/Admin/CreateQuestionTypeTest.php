<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateQuestionTypeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_question_type_requires_name()
    {
        $this->withExceptionHandling();
        $this->createQuestionType(['name' => null])
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function an_admin_can_create_a_question_type()
    {
        $name = "Multiple Choice";
        $this->createQuestionType(['name' => $name]);
        $this->assertDatabaseHas('question_types', ['name' => $name]);
    }

    private function createQuestionType($overrides = [])
    {
        $this->signInAsAdmin();
        $questionType = make('App\QuestionType', $overrides);
        return $this->post(route('admin.question_types.store'), $questionType->toArray());
    }
}
