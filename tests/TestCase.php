<?php

namespace Tests;

use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    protected function signIn($user = null)
    {
        $user = $user ?: create('App\User');
        $this->actingAs($user);
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

    // protected function disableExceptionHandling()
    // {
    //     $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);

    //     $this->app->instance(ExceptionHandler::class, new class extends Handler {
    //         public function __construct() {}
    //         public function report(\Exception $e) {}
    //         public function render($request, \Exception $e) {
    //             throw $e;
    //         }
    //     });
    // }

    // protected function withExceptionHandling()
    // {
    //     $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);

    //     return $this;
    // }
}
