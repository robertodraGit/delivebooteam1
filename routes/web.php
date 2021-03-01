<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// gruppo di rotte solo per utenti registrati
Route::group([
  'middleware' => 'auth',
], function(){

  // rotte x tutti gli order nel db
  Route::get('/orders', 'Ordercontroller@index')
    -> name('orders-index');
  Route::get('/order/{id}', 'Ordercontroller@show')
    -> name('order-show');
  // create & storeB
  Route::get('/new/order', 'OrderController@create')
    -> name('order-create');
  Route::post('/new/order/store', 'OrderController@store')
    -> name('order-store');
  // edit & update
  Route::get('/edit/{id}', 'OrderController@edit')
    -> name('order-edit');
  Route::post('/update/{id}', 'OrderController@update')
    -> name('order-update');
    // delete
  Route::get('/delete/{id}', 'OrderController@delete')
    -> name('order-delete');


  Route::get('/payment/process/{id}', 'PaymentController@process')
    ->name('payment-process');
    // ROTTA PER ESEGUIRE I PAGAMENTI TRAMITE BRAINTREE



});
