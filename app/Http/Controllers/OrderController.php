<?php

namespace App\Http\Controllers;
use App\Order;

use Illuminate\Http\Request;

class OrderController extends Controller
{
  // INDEX
  public function index() {
    $orders = Order::all();
    // ogni total price / 100 x prezzo euro
    foreach ($orders as $key => $val) {
      $val['total_price'] = $val['total_price'] / 100;
    }

    return view('pages.ordersIndex', compact('orders'));
  }
  // SHOW {id}
  public function show($id) {
    $order = Order::findOrFail($id);
    $order['total_price'] =  $order['total_price'] / 100;
    return view('pages.orderShow', compact('order'));
  }
}
