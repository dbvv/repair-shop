<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
  if (Auth::user() != null) {
    return redirect()->route('order.index');
  }
  return view('welcome');
});

Auth::routes();

Route::get('invite', 'InviteController@invite')->name('invite');
Route::post('invite', 'InviteController@process')->name('process');
// {token} is a required parameter that will be exposed to us in the controller method
Route::get('accept/{token}', 'InviteController@accept')->name('accept');

Route::group(['middleware' => 'auth'], function () {
  Route::get('/home', 'HomeController@index')->name('home');

  Route::get('profile', 'ProfileController@index')->name('profile');
  Route::post('profile', 'ProfileController@update')->name('profile.update');

  Route::group(['prefix' => 'nomenclature', 'as' => 'nomenclature.', 'namespace' => 'Nomenclature'], function () {
    Route::resource('brand', 'BrandsController');
    Route::resource('client', 'ClientsController');
    Route::resource('type', 'TypesController');
    Route::resource('workshop', 'WorkshopController');
  });

  Route::get('order-toggle/{id}', 'OrdersReadyController@toggle')->name('order.toggle');
  Route::get('order-restore/{id}', 'OrdersReadyController@restore')->name('order.restore')->middleware('role:admin');
  Route::resource('order', 'OrdersController');

  Route::get('users', 'UsersController@index')->name('users.index');
  Route::delete('users/{id}', 'UsersController@delete')->name('users.destroy');

  Route::post('user/assign-admin', 'UsersController@setAdmin')->name('users.assign-admin');
  Route::post('user/revoke-admin', 'UsersController@revokeAdmin')->name('users.revoke-admin');

  Route::get('print/{orderID}', 'PrintController@print')->name('print');
});
