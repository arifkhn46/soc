<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WelcomeController@index')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['admin']], function()
{
    //Roles Routes
    Route::post('roles', 'RolesController@store')->name('roles.store');
    Route::get('roles/create', 'RolesController@create')->name('roles.create');
    Route::get('roles', 'RolesController@index')->name('roles.list');

    //Course Routes
    Route::post('courses', 'CoursesController@store')->name('course.create');
});