<?php

namespace Tests\Feature\Teacher;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssetsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_teacher_can_add_a_html_asset_to_his_assets()
    {
        $this->signInAsTeacher();
        $description = "<h1>Content Description</h1>";
        $this->addAsset();

    }

    private function addAsset($overrides = []) {
        $asset = make('App\Asset', $overrides);
        $response = $this->post(route('teacher.asset.store'), $asset->toArray());
        return $response;
    }
}
