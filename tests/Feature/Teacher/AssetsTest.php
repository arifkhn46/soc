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
        $description = "<h1>Content Description</h1>";
        $title = "Asset1";
        $this->addAsset(['title' => $title, 'description' => $description, 'type' => 'html']);
        $this->assertDatabaseHas('assets', ['title' => $title]);
    }

    /** @test */
    function a_teacher_can_upload_a_pdf_asset_to_his_assets()
    {
        Storage::fake('public');
        $description = "<h1>Content Description</h1>";
        $file = UploadedFile::fake()->create('document.pdf');
        $this->addAsset(['type' => 'pdf', 'path' => $file]);
        $file_path = 'assets/' . $file->hashName();
        $this->assertDatabaseHas('assets', ['path' => $file_path]);
        Storage::disk('public')->assertExists($file_path);
    }

    private function addAsset($overrides = []) {
        $this->signInAsTeacher();
        $asset = make('App\Asset', $overrides);
        $content = create('App\Content');
        $response = $this->post(route('teacher.assets.store', ['content' => $content->id] ), $asset->toArray());
        return $response;
    }
}
