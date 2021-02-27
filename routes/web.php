<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'Controller@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//rotta dashboard prova
Route::get('/dashboard', 'DashboardController@show') -> name('dashboard');
