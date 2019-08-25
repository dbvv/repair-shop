<?php

namespace App\Http\Controllers\Nomenclature;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Validator;

class BrandsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $brands = Brand::filter($request->all())
      ->orderBy('id', 'desc')
      ->paginateFilter(40);
    return view('nomenclature.brands.index', compact('brands'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('nomenclature.brands.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $rules = ['name' => 'required|unique:brands'];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return redirect()
        ->back()
        ->withErrors($validator)
        ->withInput();
    }

    $brand = Brand::create(['name' => $request->get('name')]);

    flash(__('brand.created'));

    return redirect()->route('nomenclature.brand.edit', ['id' => $brand->id]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $brand = Brand::findOrFail($id);
    return view('nomenclature.brands.edit', compact('brand'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $brand = Brand::findOrFail($id);
    return view('nomenclature.brands.edit', compact('brand'));
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
    $rules = ['name' => 'unique:brands,id,' . $id];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return redirect()
        ->back()
        ->withErrors($validator)
        ->withInput();
    }

    $brand = Brand::where('id', $id)->update([
      'name' => $request->get('name'),
    ]);

    flash(__('brand.updated'));

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
    Brand::find($id)->delete();

    flash(__('brand.deleted'));

    return redirect()->route('nomenclature.brand.index');
  }
}
