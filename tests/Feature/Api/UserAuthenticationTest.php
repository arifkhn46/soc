<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_get_an_access_token_on_login()
    {
        $user = factory('App\User')->create();

        $this->json('GET', route('api.user.profile'))->assertStatus(401);

        $response = $this->jsonPost([
            'email'=> $user->email,
            'password' => 'secret'
        ], route('api.user.login'));
        
        $this->assertArrayHasKey('access_token', $response->json()['user']);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $response->json()['user']['access_token'],
        ])->json('GET', route('api.user.profile'))->assertStatus(200);
    }
}
