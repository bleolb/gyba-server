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
    $router->get('/professionals/offers', ['uses' => 'ProfessionalController@getAllOffers']);
    $router->post('/professionals/offers', ['uses' => 'ProfessionalController@createOffer']);
    $router->get('/offers/professionals', ['uses' => 'OfferController@getAllProfessionals']);
    $router->post('/users/login', ['uses' => 'UserController@getToken']);
});
$router->group(['middleware' => ['auth'], ['cors']], function () use ($router) {
    $router->get('/users', ['uses' => 'UserController@getAllUsers']);
    $router->get('/users/{id}', ['uses' => 'UserController@showUser']);
    $router->post('/users/filter', ['uses' => 'UserController@filterUsers']);
});
$router->post('/login', ['uses' => 'UserController@login']);
$router->post('/logout', ['uses' => 'UserController@logout']);
$router->post('/users', ['uses' => 'UserController@createUser']);
$router->put('/users', ['uses' => 'UserController@updateUser']);
$router->delete('/users', ['uses' => 'UserController@deleteUser']);
$router->post('/professionals/languages', ['uses' => 'ProfessionalController@createLanguage']);
$router->put('/professionals/languages', ['uses' => 'ProfessionalController@updateLanguage']);
$router->delete('/professionals/languages', ['uses' => 'ProfessionalController@deleteLanguage']);
$router->get('/professionals/languages', ['uses' => 'ProfessionalController@getAllLanguages']);
$router->get('/professionals/languages/{id}', ['uses' => 'ProfessionalController@showLanguage']);

$router->post('/offers', ['uses' => 'OfferController@createOffer']);
$router->put('/offers', ['uses' => 'OfferController@updateOffer']);
$router->delete('/offers', ['uses' => 'OfferController@deleteOffer']);

$router->get('/', function () {
    $professional = App\Professional::findOrFail(1);
    return $professional->user;
});