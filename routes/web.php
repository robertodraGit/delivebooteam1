<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'Controller@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//rotta dashboard SENZA AUTENTICAZIONE
Route::get('/dashboard', 'DashboardController@show') -> name('dashboard');


//rotte form modifica dati utente
// form
Route::get('/restaurant/info/edit', 'HomeController@restaurantEdit') -> name('restaurant_edit');

Route::post('/restaurant/info/upload', 'HomeController@uploadInfo') -> name('upload-info');
Route::get('/restaurant/photo/delete', 'HomeController@deleteIcon') -> name('delete-icon');

//Rotte plate
Route::get('/rest/plates', 'PlateController@platesIndex') -> name('plates-index');
