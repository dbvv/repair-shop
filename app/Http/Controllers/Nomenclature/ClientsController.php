<?php

namespace App\Http\Controllers\Nomenclature;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Validator;

class ClientsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    if ($request->ajax() || $request->get('term')) {
      $clients = Client::filter($request->all())->get();
      return response()->json(compact('clients'));
    }
    $clients = Client::paginate(40);

    return view('nomenclature.clients.index', compact('clients'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('nomenclature.clients.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $rules = [
      'name'  => 'required',
      'phone' => 'required|unique:clients',
    ];
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return redirect()->back()
        ->withInput()
        ->withErrors($validator);
    }

    $client = Client::create($request->all());

    flash(__('nomenclature.client.created'));

    return redirect()->route('nomenclature.client.edit', ['id' => $client->id]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $client = Client::findOrFail($id);

    return view('nomenclature.clients.edit', compact('client'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $client = Client::findOrFail($id);

    return view('nomenclature.clients.edit', compact('client'));
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
      'name'  => 'required',
      'phone' => 'required|unique:clients,id,' . $id,
    ];
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return redirect()->back()
        ->withInput()
        ->withErrors($validator);
    }

    Client::where('id', $id)->update([
      'name'    => $request->get('name'),
      'phone'   => $request->get('phone'),
      'address' => $request->get('address'),
    ]);

    flash(__('nomenclature.client.updated'));

    return redirect()->route('nomenclature.client.edit', ['id' => $id]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    Client::where('id', $id)->delete();
    flash(__('nomenclature.client.deleted'));

    return redirect()->route('nomenclature.client.index');
  }
}
