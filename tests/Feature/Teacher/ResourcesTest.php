<?php

namespace Tests\Feature\Teacher;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResourcesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_teacher_can_add_a_resource_to_its_content()
    {
        $this->signInAsTeacher();
    }

    private function addResource($overrides = []) {
        $resource = make('App\Resource', $overrides);
        $response = $this->post(route('teacher.resource.store'), $resource->toArray());
        return $response;
    }
}
