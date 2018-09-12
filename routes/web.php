<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->post('/users/login', ['uses' => 'UserController@getToken']);
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['middleware' => ['auth']], function () use ($router) {
    $router->get('/users', ['uses' => 'UserController@getAllUsers']);
    $router->post('/users', ['uses' => 'UserController@createUser']);
    $router->put('/users/{id}', ['uses' => 'UserController@updateUser']);
    $router->delete('/users/{id}', ['uses' => 'UserController@deleteUser']);
    $router->get('/users/{id}', ['uses' => 'UserController@showUser']);
    $router->post('/users/filter', ['uses' => 'UserController@filterUsers']);
});
