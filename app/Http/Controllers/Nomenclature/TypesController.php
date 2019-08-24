<?php

namespace App\Http\Controllers\Nomenclature;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Validator;

class TypesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $types = Type::paginate(40);
    return view('nomenclature.types.index', compact('types'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $types = Type::all();
    return view('nomenclature.types.create', compact('types'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $rules = ['name' => 'required|unique:types'];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return redirect()
        ->back()
        ->withErrors($validator)
        ->withInput();
    }

    $type = Type::create([
      'name'      => $request->get('name'),
      'parent_id' => $request->get('parent_id'),
    ]);

    flash(__('type.created'));

    return redirect()->route('nomenclature.type.edit', ['id' => $type->id]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $type  = Type::findOrFail($id);
    $types = Type::all();
    return view('nomenclature.types.edit', compact('type', 'types'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $type  = Type::findOrFail($id);
    $types = Type::all();
    return view('nomenclature.types.edit', compact('type', 'types'));
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
    $rules = ['name' => 'unique:types,id,' . $id];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return redirect()
        ->back()
        ->withErrors($validator)
        ->withInput();
    }

    $type = Type::where('id', $id)->update([
      'name'      => $request->get('name'),
      'parent_id' => $request->get('parent_id'),
    ]);

    flash(__('type.updated'));

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
    Type::find($id)->delete();

    flash(__('type.deleted'));

    return redirect()->route('nomenclature.type.index');
  }
}
