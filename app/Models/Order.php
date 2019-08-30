<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
  use SoftDeletes, Filterable;

  protected $fillable = [
    'id',
    'brand_id',
    'type_id',
    'model_data',
    'client_id',
    'workshop_id',
    'price',
    'client_pay',
    'notices',
    'problem',
    'imei',
    'completed',
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

  public function scopeIsCompleted($query)
  {
    return $query->where('completed', true);
  }

  public function scopeIsNotCompleted($query)
  {
    return $query->where('completed', false);
  }
}
