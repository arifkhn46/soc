<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function(){
        Route::post('login', 'Api\Auth\LoginController@login')->name('api.user.login');

        // Route::post('register', 'Api\RegisterController@register')->name('api.user.register');
        Route::group(['middleware' => 'auth:sanctum'], function(){
            Route::post('tasks', 'Api\TaskController@store')->name('api.task.create');
            Route::get('tasks', 'Api\TaskController@index')->name('api.task.my_tasks');
            Route::patch('tasks/{task}', 'Api\TaskController@update')->name('api.task.update');
            Route::get('/user', function (Request $request) {
                    return new App\Http\Resources\UserResource($request->user());
                })->name('api.user.profile');
            Route::get('subjects', 'Api\SubjectController@details')->name('api.subject.list');
            Route::get('subjects/{subject}/chapters', 'Api\SubjectController@chapters')->name('api.subject.chapters');

        });
});