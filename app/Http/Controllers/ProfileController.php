<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Validator;

class ProfileController extends Controller
{
  public function index()
  {
    $user = Auth::user();
    return view('auth.profile', compact('user'));
  }

  public function update(Request $request)
  {
    $user  = Auth::user();
    $rules = [
      'name'     => ['required', 'string', 'max:255'],
      'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return redirect()
        ->back()
        ->withInput()
        ->withErrors($validator);
    }

    $password = Hash::make($request->get('password'));

    User::where('id', $user->id)->update([
      'name'     => $request->get('name'),
      'email'    => $request->get('email'),
      'password' => $password,
    ]);

    flash(__('User is updated!'));

    return redirect()->back();
  }
}
