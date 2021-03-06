<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Authentication routes...
// Route::get('auth/login', 'Auth\AuthController@getLogin');
// Route::post('auth/login', 'Auth\AuthController@postLogin');
// Route::get('auth/logout', 'Auth\AuthController@getLogout');
//
// // Registration routes...
// Route::get('auth/register', 'Auth\AuthController@getRegister');
// Route::post('auth/register', 'Auth\AuthController@postRegister');

app('Dingo\Api\Exception\Handler')->register(function (Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException $exception) {
    return Response::make(['error' => 'Hey, what do you think you are doing!?'], 401);
});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
  $api->get('auth/', 'Nestor\Http\Controllers\Auth\AuthController@checkLogin');
  // auth
  $api->post('auth/login', 'Nestor\Http\Controllers\Auth\AuthController@postLogin');

  // registration
  $api->post('auth/register', 'Nestor\Http\Controllers\UsersController@create');

  // projects
	$api->get('projects/', 'Nestor\Http\Controllers\ProjectsController@index');
	$api->get('projects/{id}', 'Nestor\Http\Controllers\ProjectsController@show');

	$api->get('projects/{projectId}/testsuites/{testSuiteId}', ['middleware' => 'api.auth'], 'Nestor\Http\Controllers\TestSuitesController@show');
});
