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

Route::group([
  'prefix' => 'admin',
  'middleware' => 'admin',
  'namespace' => 'Admin'
], function () {
  // Route::get('/', 'DashboardController@index')->name('admin.dashboard.index');
  // Course type routes
  Route::get('/course_type/create', 'CourseTypeController@create')->name('admin.course_types.create');
  Route::post('/course_types/store', 'CourseTypeController@store')->name('admin.course_types.store');

  // Courses Route
  Route::get('/courses/create', 'CourseController@create')->name('admin.courses.create');
  Route::post('/courses/store', 'CourseController@store')->name('admin.courses.store');
  Route::get('/courses', 'CourseController@index')->name('admin.courses.index');
  Route::get('/courses/{course}/edit', 'CourseController@edit')->name('admin.courses.edit');
  Route::put('/courses/{course}', 'CourseController@update')->name('admin.courses.update');
  Route::delete('/courses/{course}', 'CourseController@destroy')->name('admin.courses.delete');
  Route::patch('/courses/{course_id}/restore', 'CourseController@restore')->name('admin.courses.restore');

  // Subject routes
  Route::post('/subject-categories/store', 'SubjectCategoriesController@store')->name('admin.subject_categories.store');
  Route::get('/subject-categories/create', 'SubjectCategoriesController@create')->name('admin.subject_categories.create');
  Route::get('/subject-categories', 'SubjectCategoriesController@index')->name('admin.subject_categories.list');
});


Route::group([
  'prefix' => 'teacher',
  'middleware' => 'teacher',
  'namespace' => 'Teacher'], function () {
  // Route::get('/', 'DashboardController@index')->name('admin.dashboard.index');
  // Content Repository.
  Route::post('/content-repositories/store', 'ContentRepositoryController@store')->name('teacher.content_repository.store')->middleware('teacher');
  Route::get('/content-repositories/create', 'ContentRepositoryController@create')->name('teacher.content_repository.create')->middleware('teacher');
  Route::get('/content-repositories', 'ContentRepositoryController@index')->name('teacher.content_repository.list')->middleware('teacher');
  Route::post('/content-repositories/store/subject', 'ContentRepositoryController@addSubject')->name('teacher.content_repository.add_subject');
});
