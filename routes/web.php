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
  'namespace' => 'Admin',
  'as' => 'admin.'
], function () {
  // Route::get('/', 'DashboardController@index')->name('admin.dashboard.index');
  // Course type routes
  Route::get('/course_type/create', 'CourseTypeController@create')->name('course_types.create');
  Route::post('/course_types/store', 'CourseTypeController@store')->name('course_types.store');

  // Courses Route
  Route::get('/courses/create', 'CourseController@create')->name('courses.create');
  Route::post('/courses/store', 'CourseController@store')->name('courses.store');
  Route::get('/courses', 'CourseController@index')->name('courses.index');
  Route::get('/courses/{course}/edit', 'CourseController@edit')->name('courses.edit');
  Route::put('/courses/{course}', 'CourseController@update')->name('courses.update');
  Route::delete('/courses/{course}', 'CourseController@destroy')->name('courses.delete');
  Route::patch('/courses/{course_id}/restore', 'CourseController@restore')->name('courses.restore');

  // Subject routes
  Route::post('/subject-categories/store', 'SubjectCategoriesController@store')->name('subject_categories.store');
  Route::get('/subject-categories/create', 'SubjectCategoriesController@create')->name('subject_categories.create');
  Route::get('/subject-categories', 'SubjectCategoriesController@index')->name('subject_categories.list');

  // Question Type.
  Route::post('/question-types/store', 'QuestionTypesController@store')->name('question_types.store');
});


Route::group([
  'prefix' => 'teacher',
  'middleware' => 'teacher',
  'namespace' => 'Teacher'], function () {
  // Route::get('/', 'DashboardController@index')->name('admin.dashboard.index');
  // Content Repository.
  Route::post('/content-repositories/store', 'ContentRepositoryController@store')->name('teacher.content_repository.store');
  Route::get('/content-repositories/create', 'ContentRepositoryController@create')->name('teacher.content_repository.create');
  Route::get('/content-repositories', 'ContentRepositoryController@index')->name('teacher.content_repository.list');

  //Content routes.
  Route::post('/content/store', 'ContentController@store')->name('teacher.content.store');

  // Asset routes.
  Route::post('/assets/{content}/store', 'AssetsController@store')->name('teacher.assets.store');
});


Route::middleware(['auth:sanctum', 'role:' . getSuperAdminRoleName()])->group(function () {
  Route::post('roles', 'RoleController@store')->name('role.store');
  Route::get('roles', 'RoleController@create')->name('role.create');
  Route::put('roles/{role}/assign-permissions', 'RoleController@update')->name('roles.assign_permissions');
  Route::get('roles/permissions', 'RoleController@index')->name('role.permissions');
  Route::get('users', 'UserController@index')->name('users.list');
  Route::patch('users/{user}/update', 'UserController@update')->name('users.update');
});

Route::get('student-app', 'WelcomeController@studentApp')->name('student_app');