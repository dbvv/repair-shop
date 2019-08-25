<?php

namespace App\ModelFilters;

use Auth;
use EloquentFilter\ModelFilter;

class OrderFilter extends ModelFilter
{
  /**
   * Related Models that have ModelFilters as well as the method on the ModelFilter
   * As [relationMethod => [input_key1, input_key2]].
   *
   * @var array
   */
  public $relations = [
    'client'   => ['name', 'phone', 'address'],
    'brand'    => ['name'],
    'type'     => ['name'],
    'workshop' => ['name'],
  ];

  public function setup()
  {
    $this->onlyShowDeletedForAdmins();
  }

  public function onlyShowDeletedForAdmins()
  {
    if (Auth::user()->hasRole('admin')) {
      $this->withTrashed();
    }
  }

  public function search($str)
  {
    return $this->where(function ($q) use ($str) {
      return $q->where('model_data', 'LIKE', "%$str%")
        ->orWhere('notices', 'LIKE', "%$str%")
        ->orWhere('problem', 'LIKE', "%$str%");
    })
      ->orWhereHas('client', function ($query) use ($str) {
        return $query->where('name', 'LIKE', "%$str%")
          ->orWhere('phone', 'LIKE', "%$str%")
          ->orWhere('address', 'LIKE', "%$str%");
      })
      ->orWhereHas('brand', function ($query) use ($str) {
        return $query->where('name', 'LIKE', "%$str%");
      })
      ->orWhereHas('type', function ($query) use ($str) {
        return $query->where('name', 'LIKE', "%$str%");
      })
      ->orWhereHas('workshop', function ($query) use ($str) {
        return $query->where('name', 'LIKE', "%$str%");
      })
    ;
  }
}
