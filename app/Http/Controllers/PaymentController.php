<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Order;
use App\Plate;
use App\User;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;


class PaymentController extends Controller
{
  public function create(Request $request) {

    dd($request -> all());
    
    $user = User::all() -> first() -> id;
    $plates = [];

    $platesAll = Plate::all();

    foreach ($platesAll as $plate) {
      if ($plate['user_id'] == $user) {
        $plates[] = $plate;
      }
    }

    return view('orders.order-create', compact('plates'));
  }

  public function store(Request $request) {
    $data = $request -> all();
    // dd($data);

    // result è un array con id dei plates selected
    foreach ($data as $key => $value) {
      $exp_key = explode('_', $key);
      if($exp_key[0] == 'plate'){
         $id_plates[] = $value;
       }
    }
    // dd($id_plates);

    $tot_price = 0;
    $plates = Plate::all();
    $platesAttach = [];

    foreach ($plates as $plate) {
      foreach ($id_plates as $id_frontend) {
        // dd($id_frontend, $plate -> id);
        if ($id_frontend == $plate -> id) {
          $tot_price = $tot_price + $plate -> price;
          $platesAttach[] = $plate;
        }
      }
    }
    // dd($tot_price);

    $data['total_price'] = $tot_price;

    // array di piatti ordinati
    $platesOrd = [];

    foreach ($data as $key => $value) {
      $exp_key = explode('_', $key);
      if($exp_key[0] == 'plate'){
         $platesOrd[] = $value;
         unset($data[$key]);
       }
    }
    // dd($platesOrd, $data);

    $data['payment_state'] = 0;

    Validator::make($data, [

      'first_name' =>  'required|string|min:2|max:50',
      'last_name' =>  'required|string|min:2|max:50',
      'email' => 'required|string|min:3|max:50',
      'phone' => 'required|string|min:3|max:30',
      'comment' => 'nullable|string|min:0|max:255',
      'address' => 'required|string|min:5|max:255',
      'total_price' =>  'required|integer|min:0|max:999999',

    ]) -> validate();

    $newOrder = Order::make($data);
    $newOrder -> save();
    $newOrder -> plates() -> attach($id_plates);
    // dd($newOrder);


    return view('orders.order-show', compact('newOrder'));
  }

  // public function edit($id) {
  //   $order = Order::findOrFail($id);
  //   // dd($order);
  //   return view('orders.order-edit', compact('order'));
  // }


  //METODO DI PAGAMENTO
  public function process(Request $request) {

    $data = $request -> all();
    dd($data);

    $id = $request -> id;
    $payload = $request -> payload;
    $price = $request -> price;

    // data pagamento
    $now = date('Y-m-d H:i:s');

    $nonce = $payload['nonce'];


    $status = \Braintree\Transaction::sale([
                                   'amount' => $price,
                                    'paymentMethodNonce' => $nonce,
                                    'options' => [
                                   'submitForSettlement' => True
                                     ]
    ]);

    $order = Order::findOrFail($id);
    // setto ordine in questione pagato
    $order['payment_state'] = 1;
    $order -> save();

    return response()->json($status, 200);
  }


  public function sendMail() {
    Mail::to($user['email'])->send(new SendMail($user));
  }

}
