<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Order;
use App\Plate;

// temporaneo
use App\User;

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

  public function restaurantOrder(){
    $user = Auth::user();

    $user = User::findOrFail(3);

    $plateOrders = [];
    $userOrders = [];
    foreach ($user -> plates as $plate) {

      $orders = [];
      foreach ($plate -> orders as $order) {
        $orders[] = $order;
        $userOrders[] = $order -> id;
      }
      $plateOrders[] = $orders;
    }

    // dd($user -> id ,$plateOrders, $userOrders);
    // $userOrders contiene gli id di tutti gli ordini relativi a quel ristorante.
    // Gli id possono essere anche duplicati quindi vanno scremati.

    $userOrders = array_unique($userOrders);
    dd($userOrders);

    return view('dashboard.orders', compact('user'));
  }


}
