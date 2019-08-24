<?php

namespace App\Http\Controllers;

use App\user;
use Auth;
use Illuminate\Http\Request;

class UsersController extends Controller
{
  public function __construct()
  {
    $this->middleware('role:admin');
  }

  public function index()
  {
    $users = User::all();

    return view('auth.users', compact('users'));
  }

  public function setAdmin(Request $request)
  {
    $adminCandidat = User::findOrFail($request->get('user_id'));

    $adminCandidat->assignRole('admin');

    flash(__('users.admin_assigned'));

    return redirect()->back();
  }

  public function revokeAdmin(Request $request)
  {
    $id = $request->get('user_id');
    if ($id != 1 && Auth::user()->id != $id) {
      $looser = User::findOrFail($request->get('user_id'));

      $looser->removeRole('admin');

      flash(__('users.admin_removed'));
    } else {
      return redirect()->back();
    }

    return redirect()->back();
  }

  public function delete($id)
  {
    if ($id != 1 && Auth::user()->id != $id) {
      User::where('id', $id)->delete();
      flash(__('users.user_deleted'));
    } else {
      flash(__('users.cannot_delete', 'danger'));
    }
    return redirect()->back();
  }
}
