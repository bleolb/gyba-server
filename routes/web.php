<?php

//Users
$router->post('/users', ['uses' => 'UsersController@create']);
$router->put('/users', ['uses' => 'UsersController@update']);
$router->delete('/users', ['uses' => 'UsersController@delete']);

//Books
$router->post('/books', ['uses' => 'BooksController@create']);
$router->put('/books', ['uses' => 'BooksController@update']);
$router->delete('/books', ['uses' => 'BooksController@delete']);

//BookCopies
$router->post('/book_copies', ['uses' => 'BookCopiesController@create']);
$router->put('/book_copies', ['uses' => 'BookCopiesController@update']);
$router->delete('/book_copies', ['uses' => 'BookCopiesController@delete']);

//Sanctions
$router->post('/sanctions', ['uses' => 'SanctionsController@create']);
$router->put('/sanctions', ['uses' => 'SanctionsController@update']);
$router->delete('/sanctions', ['uses' => 'SanctionsController@delete']);

//Reservations
$router->post('/reservations', ['uses' => 'ReservationsController@create']);
$router->put('/reservations', ['uses' => 'ReservationsController@update']);
$router->delete('/reservations', ['uses' => 'ReservationsController@delete']);

//Detail Reservations
$router->post('/detail_reservations', ['uses' => 'DetailReservationsController@create']);
$router->put('/detail_reservations', ['uses' => 'DetailReservationsController@update']);
$router->delete('/detail_reservations', ['uses' => 'DetailReservationsController@delete']);

?>