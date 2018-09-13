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

$router->group(['middleware' => ['cors']], function () use ($router) {
    $router->get('/users', ['uses' => 'UserController@getAllUsers']);
    $router->get('/profesionals/offers', ['uses' => 'ProfesionalController@getAllOffers']);
    $router->post('/profesionals/offers', ['uses' => 'ProfesionalController@createOffer']);
    $router->get('/offers/profesionals', ['uses' => 'OfferController@getAllProfesionals']);
    $router->post('/users/login', ['uses' => 'UserController@getToken']);
});
$router->group(['middleware' => ['auth'], ['cors']], function () use ($router) {

    $router->put('/users/{id}', ['uses' => 'UserController@updateUser']);
    $router->delete('/users/{id}', ['uses' => 'UserController@deleteUser']);
    $router->get('/users/{id}', ['uses' => 'UserController@showUser']);
    $router->post('/users/filter', ['uses' => 'UserController@filterUsers']);
});
$router->post('/users', ['uses' => 'UserController@createUser']);