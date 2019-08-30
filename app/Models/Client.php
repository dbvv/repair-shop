<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use EloquentFilter\Filterable;

class Client extends Model
{
  use SoftDeletes, Filterable;
  protected $fillable = ['id', 'name', 'phone', 'address'];

  public function orders()
  {
    return $this->hasMany('App\Models\Order');
  }
}
