<?php


$router->post('/users', ['uses' => 'UsersController@create']);
$router->put('/users', ['uses' => 'UsersController@update']);
//$router->delete('/users', ['uses' => 'UsersController@delete']);
$router->delete('/users', ['uses' => 'UsersController@delete2']);
$router->get('/books/show', ['uses' => 'BooksController@show']);
