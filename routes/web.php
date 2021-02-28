<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'Controller@index') -> name ('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//rotta dashboard autenticata
Route::get('/restaurant', 'HomeController@dashboard') -> name('dashboard');


//rotte form modifica dati utente
// form
Route::get('/restaurant/info/edit', 'HomeController@restaurantEdit') -> name('restaurant-edit');

Route::post('/restaurant/info/upload', 'HomeController@uploadInfo') -> name('upload-info');
Route::get('/restaurant/photo/delete', 'HomeController@deleteIcon') -> name('delete-icon');

//Rotte plate
Route::get('/rest/plates', 'PlateController@platesIndex') -> name('plates-index');
