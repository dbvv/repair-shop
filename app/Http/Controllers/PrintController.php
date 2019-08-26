<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class PrintController extends Controller
{
  function print(Request $request, $orderID) {
    $order = Order::where('id', $orderID)->with('client', 'workshop', 'brand', 'type')->firstOrFail();

    return view('orders.preview', compact('order'));
  }
}
