<?php

namespace Tests\Feature\Teacher;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssetsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_teacher_can_add_a_html_asset_to_his_assets()
    {
        $this->signInAsTeacher();
        $description = "<h1>Content Description</h1>";
        $title = "Asset1";
        $this->addAsset(['title' => $title, 'description' => $description, 'type' => 'html']);
        $this->assertDatabaseHas('assets', ['title' => $title]);
    }

    /** @test */
    function a_teacher_can_upload_a_pdf_asset_to_his_assets()
    {
        Storage::fake('public');
        $this->signInAsTeacher();
        $description = "<h1>Content Description</h1>";
        $file = UploadedFile::fake()->create('document.pdf');
        $this->addAsset(['type' => 'pdf', 'path' => $file]);
        Storage::disk('public')->assertExists('assets/' . $file->hashName());
    }

    private function addAsset($overrides = []) {
        $asset = make('App\Asset', $overrides);
        $response = $this->post(route('teacher.assets.store'), $asset->toArray());
        return $response;
    }
}
