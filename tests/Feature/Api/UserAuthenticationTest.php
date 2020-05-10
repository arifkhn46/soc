<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCaseApi;

class UserAuthenticationTest extends TestCaseApi
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_get_an_access_token_on_login()
    {
        $user = factory('App\User')->create();

        $this->json('GET', route('api.user.profile'))->assertStatus(401);

        $response = $this->json('POST', route('api.user.login'), [
            'email'=> $user->email,
            'password' => 'secret'
        ])->assertStatus(200);

        $this->assertArrayHasKey('access_token', $response->json());

        $this->withHeaders([
            'Authorization' => 'Bearer '. $response->json()['access_token'],
        ])->json('GET', route('api.user.profile'))->assertStatus(200);
    }
}
