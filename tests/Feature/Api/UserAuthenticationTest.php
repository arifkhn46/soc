<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_login()
    {
        $this->withoutExceptionHandling();
        $user = factory('App\User')->create();

        $response = $this->json('POST', route('api.user.login'), [
            'email'=> $user->email,
            'password' => 'secret'
        ])->assertStatus(200);

        $this->assertArrayHasKey('access_token', $response->json());
    }
}
