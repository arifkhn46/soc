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

// Course type routes
Route::get('/course_type/create', 'CourseTypeController@create')->name('course.types.create')->middleware('auth');
Route::post('/course_type/store', 'CourseTypeController@store')->name('course.types.store')->middleware('auth');

// Courses Route
Route::get('/courses/create', 'CourseController@create')->name('courses.create')->middleware('auth');
Route::post('/courses/store', 'CourseController@store')->name('courses.store')->middleware('auth');
Route::get('/courses', 'CourseController@index')->name('courses.index')->middleware('auth');
Route::get('/courses/{course}/edit', 'CourseController@edit')->name('courses.edit')->middleware('auth');
Route::put('/courses/{course}', 'CourseController@update')->name('courses.update')->middleware('auth');
Route::delete('/courses/{course}', 'CourseController@destroy')->name('courses.delete')->middleware('auth');
Route::patch('/courses/{course_id}/restore', 'CourseController@restore')->name('courses.restore')->middleware('auth');