<?php

namespace App\Http\Controllers;

use App\Mail\UserInviteMail;
use App\Models\Invite;
use Illuminate\Http\Request;
use Mail;
use Validator;

class InviteController extends Controller
{
  /**
   * new user invite
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function process(Request $request)
  {
    $rules = [
      'email' => 'required|unique:users|email',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      Log::error($validator->errors());
      return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }

    do {
      //generate a random string using Laravel's str_random helper
      $token = str_random();
    } //check if the token already exists and if it does, try again
    while (Invite::where('token', $token)->first());

    $invite = Invite::create([
      'email' => $request->email,
      'role'  => isset($request['role']) ? $request->role : 'manager',
      'token' => $token,
    ]);

    // send email with invite
    Mail::to($request->get('email'))->send(new UserInviteMail($invite));

    flash(__('User is invited!'));

    return redirect()->back();
  }

  /**
   * Accept invite
   * @param  [type] $token [description]
   * @return [type]        [description]
   */
  public function accept($token)
  {
    // Look up the invite
    if (!$invite = Invite::where('token', $token)->first()) {
      //if the invite doesn't exist do something more graceful than this
      abort(404);
    }

    return view('auth.invite-register', compact('invite'));
  }

  public function invite()
  {
    return view('auth.invite');
  }
}
