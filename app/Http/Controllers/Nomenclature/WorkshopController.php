<?php

namespace App\Http\Controllers\Nomenclature;

use App\Http\Controllers\Controller;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Validator;

class WorkshopController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $workshops = Workshop::filter($request->all())->paginateFilter(40);
    return view('nomenclature.workshops.index', compact('workshops'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('nomenclature.workshops.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $rules = ['name' => 'required|unique:workshops'];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return redirect()
        ->back()
        ->withErrors($validator)
        ->withInput();
    }

    $workshop = Workshop::create(['name' => $request->get('name')]);

    flash(__('workshop.created'));

    return redirect()->route('nomenclature.workshop.edit', ['id' => $workshop->id]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $workshop = Workshop::findOrFail($id);
    return view('nomenclature.workshops.edit', compact('workshop'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $workshop = Workshop::findOrFail($id);
    return view('nomenclature.workshops.edit', compact('workshop'));
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
    $rules = ['name' => 'unique:workshops,id,' . $id];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return redirect()
        ->back()
        ->withErrors($validator)
        ->withInput();
    }

    $workshop = Workshop::where('id', $id)->update([
      'name' => $request->get('name'),
    ]);

    flash(__('workshop.updated'));

    return redirect()->back();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    Workshop::find($id)->delete();

    flash(__('workshop.deleted'));

    return redirect()->route('nomenclature.workshop.index');
  }
}
