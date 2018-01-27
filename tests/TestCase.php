<?php

namespace Tests;

use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Admin user.
     */
    protected $admin;

    protected function setUp()
    {
        parent::setUp();
        $this->disableExceptionHandling();
    }

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


    protected function signInAsTeacher()
    {
        $teacher = create('App\User', ['email' => 'jyoti.raman2013@gmail.com']);
        $this->actingAs($teacher);
        return $teacher;
    }

    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);

        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct() {}
            public function report(\Exception $e) {}
            public function render($request, \Exception $e) {
                throw $e;
            }
        });
    }

    protected function withExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);

        return $this;
    }
}
