<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContentTest extends TestCase
{
    use RefreshDatabase;

    protected $content;

    public function setUp() : void
    {
        parent::setUp();

        $this->content = create(\App\Content::class);
    }


    /** @test */
    public function a_content_has_assets()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->content->assets
        );

    }

    /** @test */
    public function a_content_can_add_an_asset()
    {
        $asset = make('App\Asset')->toArray();
        $this->assertCount(0, $this->content->assets);
        $this->content->addAsset($asset);
        $this->assertCount(1, $this->content->fresh()->assets);
    }

}
