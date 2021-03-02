<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Order;

class OrderController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index() {

    $user = Auth::user();
    return view('orders.orders-index', compact('user'));
  }

  public function show($id) {

    $order = Order::findOrFail($id);
    $order['total_price'] =  $order['total_price'] / 100;

    return view('orders.order-show', compact('order'));
  }
}
