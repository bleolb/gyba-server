<?php

//Users
$router->post('/users', ['uses' => 'UsersController@create']);
$router->put('/users', ['uses' => 'UsersController@update']);
//$router->delete('/users', ['uses' => 'UsersController@delete']);
$router->delete('/users', ['uses' => 'UsersController@delete2']);

//Books
$router->post('/books', ['uses' => 'BooksController@create']);
$router->delete('/books', ['uses' => 'BooksController@delete']);

//BookCopies
$router->post('/book_copies', ['uses' => 'BookCopiesController@create']);
$router->delete('/book_copies', ['uses' => 'BookCopiesController@delete']);

//Sanctions
$router->post('/sanctions', ['uses' => 'SanctionsController@create']);
$router->put('/sanctions', ['uses' => 'SanctionsController@update']);
$router->delete('/sanctions', ['uses' => 'SanctionsController@delete']);

//Reservations
$router->post('/reservations', ['uses' => 'ReservationsController@create']);
$router->put('/reservations', ['uses' => 'ReservationsController@update']);
$router->delete('/reservations', ['uses' => 'ReservationsController@delete']);

?>