<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;


class PaymentController extends Controller
{
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
