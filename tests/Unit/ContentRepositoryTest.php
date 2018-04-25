<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContentRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_content_repository_consists_of_contents()
    {
        $this->signInAsTeacher();
        $contentRepository = create(\App\ContentRepository::class);
        $content = create(\App\Content::class, ['content_repository_id' => $contentRepository->id]);
        $this->assertTrue($contentRepository->contents->contains($content));
    }
}
