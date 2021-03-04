<?php

use Illuminate\Support\Facades\Route;
use App\Mail\PayMail;
use App\User;

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


  Route::get('/create/order', 'PaymentController@create')
      -> name('order-create');
  Route::post('/new/order/store', 'PaymentController@store')
      -> name('order-store');


  Route::post('send/mail', 'MailController@sendMail')
      ->name('send-mail');


  // test per rotta PAGAMENTO CI STO LAVORANDO MI STA EXP LA TESTA!!!!
  Route::get('/pay', function() {
    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);
    $email = "email utente";

    $token = $gateway->ClientToken()->generate();

    return view('pagamento.payment', [
      'token' => $token,
      'email' => $email
    ]);
  });


  // CHECKOUT PAGAMENTO
  Route::post('/checkout', function(Request $request) {

    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

    $emailPagamento = $_POST["email"];
    $userMail = User::all() -> first() -> email;
    // mail del ristorante
    // dd($userMail);

    $data = [];
    // passaggio della mail utente
    // dd($emailPagamento);

    Mail::to($userMail)->send(new PayMail($userMail));

    // Mail::send('mail.mail_pagamento', $data, function($message) {
    //   $message->from($userMail);
    //   $message->to($emailPagamento);
    // });


    $amount = $_POST["amount"];
    $nonce = $_POST["payment_method_nonce"];

    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'customer' => [
          'firstName' => 'Tony',
          'lastName' => 'Stark',
          'email' => 'tony@avengers.com'
        ],
        'options' => [
        'submitForSettlement' => true
        ]
    ]);

    if ($result->success) {
        // header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);
        return back() -> with('success_message', 'transazione eseguita con successo. Id transazione:');
    } else {
        $errorString = "";

        foreach($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }

        // $_SESSION["errors"] = $errorString;
        // header("Location: " . $baseUrl . "index.php");
        return back() -> withErrors('An error occured with the message: ' . $result -> message);
    }
  });
