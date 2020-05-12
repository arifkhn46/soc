<?php

namespace Tests;

use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    protected function signIn($user = null)
    {
        $user = $user ?: create('App\User');
        Sanctum::actingAs(
            $user,
            ['*']
        );
        return $this;
    }

    protected function signInAsAdmin()
    {
        $admin = create('App\User', ['email' => 'arifkhn46@gmail.com']);
        $this->actingAs($admin);
        return $admin;
    }


    protected function signInAsTeacher($overrides = [])
    {
        if(empty($overrides['email'])) {
            $overrides['email'] = 'jyoti.raman2013@gmail.com';
        }
        $teacher = create('App\User', $overrides);
        $this->actingAs($teacher);
        return $teacher;
    }


    /**
     * Json Post helper
     */
    public function jsonPost(array $data, string $route, $headers = [])
    {
        if ($headers) {
            $this->withHeaders($headers);
        }

        return $this->json('POST', $route, $data);

    }

}
