<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{
  // INDEX
  public function index() {
    $orders = Order::all();
    // ogni total price / 100 x prezzo euro
    foreach ($orders as $key => $val) {
      $val['total_price'] = $val['total_price'] / 100;
    }

    return view('orders.orders-index', compact('orders'));
  }
  // SHOW {id}
  public function show($id) {
    $order = Order::findOrFail($id);
    $order['total_price'] =  $order['total_price'] / 100;
    return view('orders.order-show', compact('order'));
  }
}
