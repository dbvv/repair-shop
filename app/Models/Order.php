<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
  use SoftDeletes, Filterable;

  protected $fillable = [
    'brand_id',
    'type_id',
    'model_data',
    'client_id',
    'workshop_id',
    'price',
    'client_pay',
    'notices',
    'problem',
  ];

  public function brand()
  {
    return $this->belongsTo('App\Models\Brand')->withTrashed();
  }

  public function type()
  {
    return $this->belongsTo('App\Models\Type')->withTrashed();
  }

  public function client()
  {
    return $this->belongsTo('App\Models\Client')->withTrashed();
  }

  public function workshop()
  {
    return $this->belongsTo('App\Models\Workshop')->withTrashed();
  }
}
