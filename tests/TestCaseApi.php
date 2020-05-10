<?php

namespace Tests;

use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;

abstract class TestCaseApi extends BaseTestCase
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

}
