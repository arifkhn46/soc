<?php

namespace Tests\Feature\Teacher;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssetsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_teacher_can_add_a_html_asset_to_his_content()
    {
        $this->signInAsTeacher();
    }

    private function addResource($overrides = []) {
        $resource = make('App\Resource', $overrides);
        $response = $this->post(route('teacher.resource.store'), $resource->toArray());
        return $response;
    }
}
