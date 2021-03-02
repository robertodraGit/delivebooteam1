<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Order;
use App\Plate;
use App\User;


class PaymentController extends Controller
{
  public function create() {
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
    // dd($data[]);

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

    foreach ($plates as $plate) {
      foreach ($id_plates as $id_frontend) {
        // dd($id_frontend, $plate -> id);
        if ($id_frontend == $plate -> id) {
          $tot_price = $tot_price + $plate -> price;
        }
      }
    }
    dd($tot_price);

    // da fare:
    // validator

    // Validator::make($data, [
        // varie validation
    // ]) -> validate();

    // associare total price all'ordine
    // associare piatti ad ordine -> attach();
    // return view del pagamento/carrello








    return view('orders.order-show');
  }























  //FUNZIONE DI PAGAMENTO
  public function process(Request $request) {

    $res = $request->all();
    dd($res);

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

    // VALUTARE SALVATAGGIO DATI CON UNA NUOVA TABELLA DB
    // DB::table('order_history')->insert([
    //   'created_at' => $now,
    //   'order_id' => $id,
    //   'payload' => $payload,
    // ]);
    return response()->json($status, 200);
  }

}
