<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrdersReadyController extends Controller
{
  public function toggle(Request $request, $id)
  {
    $order            = Order::findOrFail($id);
    $order->completed = !$order->completed;
    $order->save();
    flash(__('order.updated'));
    return redirect()->back();
  }
}
