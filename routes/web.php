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

// Exam type routes
Route::get('/exam_type/create', 'ExamTypeController@create')->name('exam.type.create')->middleware('auth');
Route::post('/exam_type/store', 'ExamTypeController@store')->name('exam.type.store')->middleware('auth');

// Courses Route
Route::get('/courses/create', 'CourseController@create')->name('courses.create')->middleware('auth');
Route::post('/courses/store', 'CourseController@store')->name('courses.store')->middleware('auth');