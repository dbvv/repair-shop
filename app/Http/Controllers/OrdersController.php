<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Order;
use App\Models\Type;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Validator;

class OrdersController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $orders = Order::with('client', 'brand', 'type', 'workshop')
      ->filter($request->all())
      ->orderBy('id', 'desc')
      ->paginateFilter(40);

    return view('orders.index', compact('orders'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $types     = Type::all();
    $brands    = Brand::all();
    $workshops = Workshop::all();
    return view('orders.create', compact('types', 'brands', 'workshops'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // dd($request);
    $rules = [
      'client_id'   => 'required',
      'brand_id'    => 'required',
      'type_id'     => 'required',
      'workshop_id' => 'required',
      'model_data'  => 'required',
      'price'       => 'integer|min:0',
      'client_pay'  => 'integer',
      'problem'     => 'required',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return redirect()
        ->back()
        ->withErrors($validator)
        ->withInput();
    }

    $data = [
      'client_id'   => $request->get('client_id'),
      'brand_id'    => $request->get('brand_id'),
      'type_id'     => $request->get('type_id'),
      'workshop_id' => $request->get('workshop_id'),
      'model_data'  => $request->get('model_data'),
      'price'       => (int) $request->get('price'),
      'client_pay'  => (int) $request->get('client_pay'),
      'notices'     => $request->get('notices'),
      'problem'     => $request->get('problem'),
      'imei'        => $request->get('imei'),
    ];
    // dd($data);

    $order = Order::create($data);

    flash(__('order.created'));

    return redirect()->route('order.index')->with('order_id', $order->id);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request, $id)
  {
    $order = Order::where('id', $id)->with('client', 'workshop', 'brand', 'type')->firstOrFail();

    if ($request->ajax()) {
      return view('orders.preview', compact('order'));
    }

    $types     = Type::all();
    $brands    = Brand::all();
    $workshops = Workshop::all();

    return view('orders.edit', compact('order', 'types', 'brands', 'orders', 'workshops'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $order = Order::where('id', $id)->with('client', 'workshop', 'brand', 'type', 'workshop')->firstOrFail();

    $types     = Type::all();
    $brands    = Brand::all();
    $workshops = Workshop::all();

    return view('orders.edit', compact('order', 'types', 'brands', 'orders', 'workshops'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $rules = [
      'client_id'   => 'required',
      'brand_id'    => 'required',
      'type_id'     => 'required',
      'workshop_id' => 'required',
      'model_data'  => 'required',
      'price'       => 'required',
      'problem'     => 'required',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return redirect()
        ->back()
        ->withErrors($validator)
        ->withInput();
    }

    $order = Order::where('id', $id)->update([
      'client_id'   => $request->get('client_id'),
      'brand_id'    => $request->get('brand_id'),
      'type_id'     => $request->get('type_id'),
      'workshop_id' => $request->get('workshop_id'),
      'model_data'  => $request->get('model_data'),
      'price'       => $request->get('price'),
      'client_pay'  => $request->get('client_pay'),
      'notices'     => $request->get('notices'),
      'problem'     => $request->get('problem'),
      'imei'        => $request->get('imei'),
    ]);

    flash(__('order.updated'));

    return redirect()->route('order.edit', ['id' => $id]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    Order::where('id', $id)->delete();

    return redirect()->route('order.index');
  }
}
