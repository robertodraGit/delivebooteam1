<?php

use Illuminate\Support\Facades\Route;



Route::get('/', 'Controller@index') -> name ('index');

Auth::routes();

Route::get('/home', 'HomeController@index')
->name('home');


//rotta dashboard autenticata
Route::get('/restaurant', 'DashboardController@dashboard') -> name('dashboard');


//rotte form modifica dati utente
// form
Route::get('/restaurant/info/edit', 'HomeController@restaurantEdit') -> name('restaurant-edit');

Route::post('/restaurant/info/upload', 'HomeController@uploadInfo') -> name('upload-info');
Route::get('/restaurant/photo/delete', 'HomeController@deleteIcon') -> name('delete-icon');


//Rotte plate
Route::get('/rest/plates', 'PlateController@platesIndex') -> name('plates-index');
Route::get('/restaurant/plates/new-plate', 'PlateController@platesCreate') -> name('plates-create');
Route::post('restaurant/plates/store-plate', 'PlateController@plateStore') -> name('plates-store');
Route::get('/restaurant/plates/edit/{id}', 'PlateController@platesEdit') -> name ('plates-edit');
Route::post('/restaurant/plates/edit/update/{id}', 'PlateController@platesUpdate') -> name ('plates-update');
Route::get('/restaurant/plates/delete/img/{id}', 'PlateController@deleteImg') -> name('plate-delete-img');
Route::get('/restaurant/plates/remove/{id}', 'PlateController@deletePlate') -> name('delete-plate');
//Rotta temporanea: tutti i ristoranti. Dopo da integrare nella home.
Route::get('/home/allrestaurant', 'Controller@allRestaurant') -> name('show-all-restaurant');
Route::get('/home/getallrestaurant', 'Controller@getAllRestaurant') -> name('get-all-restaurant');
Route::get('/restaurant/{id}', 'Controller@restaurantShow') -> name('restaurant-show');


//Dashboard -> visualizza ordini
Route::get('/dashboard/restaurant/orders', 'OrderController@restaurantOrder') -> name('restaurant-order');
Route::get('/dashboard/restaurant/comanda/{id}', 'OrderController@restaurantComanda') -> name('restaurant-comanda');


// rotte x tutti gli order nel db
Route::get('/orders', 'OrderController@index')
    -> name('orders-index');
Route::get('/order/{id}', 'OrderController@show')
    -> name('order-show');

  // route to get data from frontend
Route::post('/keep-cart', 'PaymentController@getCart') 
    -> name('get-cart');
  // route to checkout view with data from frontend-cart
Route::get('/create/order', 'PaymentController@create')
      -> name('order-create');
  // route stores datas for new orders and let window go to payment page
Route::post('/new/order/store', 'PaymentController@storeOrder')
      -> name('order-store');



  //rotta PAGAMENTO 
Route::get('/pay', 'PaymentController@pay') -> name('pay');


  // CHECKOUT PAGAMENTO
Route::post('/checkout', 'PaymentController@checkout') ->name('checkout');
