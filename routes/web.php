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
$router->get('/prueba', ['uses' => 'UserController@prueba']);
/* Rutas con autenticacion*/
$router->group(['middleware' => ['auth']], function () use ($router) {

    $router->post('/logout', ['uses' => 'UserController@logout']);

    /* Rutas para los usuarios*/
    $router->get('/users', ['uses' => 'UserController@getAllUsers']);
    $router->get('/users/{id}', ['uses' => 'UserController@showUser']);
    $router->post('/users/filter', ['uses' => 'UserController@filterUsers']);
    $router->put('/users', ['uses' => 'UserController@updateUser']);
    $router->delete('/users', ['uses' => 'UserController@deleteUser']);
    /**********************************************************************************************************************/

    /* Rutas para las ofertas*/
    $router->get('/offers/professionals', ['uses' => 'OfferController@getAllProfessionals']);
    $router->post('/offers/professionals', ['uses' => 'OfferController@createProfessional']);

    $router->post('/offers', ['uses' => 'OfferController@createOffer']);
    $router->put('/offers', ['uses' => 'OfferController@updateOffer']);
    $router->delete('/offers', ['uses' => 'OfferController@deleteOffer']);
    /**********************************************************************************************************************/

    /* Rutas para los profesionales*/
    $router->get('/professionals/offers', ['uses' => 'ProfessionalController@getAllOffers']);
    $router->post('/professionals/offers/filter', ['uses' => 'ProfessionalController@filterOffers']);
    $router->post('/professionals/offers', ['uses' => 'ProfessionalController@createOffer']);

    $router->post('/professionals', ['uses' => 'ProfessionalController@createProfessional']);
    $router->put('/professionals', ['uses' => 'ProfessionalController@updateProfessional']);
    $router->delete('/professionals', ['uses' => 'ProfessionalController@deleteProfessional']);
    /**********************************************************************************************************************/

    /* Rutas para los idiomas*/
    $router->get('/languages', ['uses' => 'LanguageController@getAllLanguages']);
    $router->get('/languages/{id}', ['uses' => 'LanguageController@showLanguage']);
    $router->post('/languages', ['uses' => 'LanguageController@createLanguage']);
    $router->put('/languages', ['uses' => 'LanguageController@updateLanguage']);
    $router->delete('/languages', ['uses' => 'LanguageController@deleteLanguage']);
    /**********************************************************************************************************************/

    /* Rutas para las fortalezas*/
    $router->get('/abilities', ['uses' => 'AbilityController@getAllAbilities']);
    $router->get('/abilities/{id}', ['uses' => 'AbilityController@showAbility']);
    $router->post('/abilities', ['uses' => 'AbilityController@createAbility']);
    $router->put('/abilities', ['uses' => 'AbilityController@updateAbility']);
    $router->delete('/abilities', ['uses' => 'AbilityController@deleteAbility']);
    /**********************************************************************************************************************/

    /* Rutas para los cursos*/
    $router->get('/courses', ['uses' => 'CourseController@getAllCourses']);
    $router->get('/courses/{id}', ['uses' => 'CourseController@showCourse']);
    $router->post('/courses', ['uses' => 'CourseController@createCourse']);
    $router->put('/courses', ['uses' => 'CourseController@updateCourse']);
    $router->delete('/courses', ['uses' => 'CourseController@deleteCourse']);
    /**********************************************************************************************************************/

    /* Rutas para las empresas*/
    $router->get('/companies/offers', ['uses' => 'CompanyController@getAllOffers']);
    $router->post('/companies/offers/filter', ['uses' => 'CompanyController@filterOffers']);
    $router->get('/companies', ['uses' => 'CompanyController@getAllCompanies']);
    $router->get('/companies/{id}', ['uses' => 'CompanyController@showCompany']);
    $router->put('/companies', ['uses' => 'CompanyController@updateCompany']);
    $router->delete('/companies', ['uses' => 'CompanyController@deleteCompany']);
    /**********************************************************************************************************************/

});


/* Rutas publicas*/

/* Rutas para login y logout*/
$router->post('/login', ['uses' => 'UserController@login']);
/**********************************************************************************************************************/

/* Rutas para registar usuarios (Profesionales y Empresas)*/
$router->post('/users/createCompanyUser', ['uses' => 'UserController@createCompanyUser']);
$router->post('/users/createProfessionalUser', ['uses' => 'UserController@createProfessionalUser']);
/**********************************************************************************************************************/

/* Rutas para obtener todos los profesionales y ofertas*/
$router->get('/professionals', ['uses' => 'ProfessionalController@getAllProfessionals']);
$router->get('/offers', ['uses' => 'OfferController@getAllOffers']);
/**********************************************************************************************************************/

/* Rutas para filtrar a los profesionales y ofertas*/
$router->post('/offers/filter', ['uses' => 'OfferController@filterOffers']);
$router->post('/professionals/filter', ['uses' => 'ProfessionalController@filterProfessionals']);
/**********************************************************************************************************************/


