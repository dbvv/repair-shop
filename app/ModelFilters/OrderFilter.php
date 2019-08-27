<?php

namespace App\ModelFilters;

use Auth;
use EloquentFilter\ModelFilter;
use Date;
use Validator;

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

      $query = $q->where('model_data', 'LIKE', "%$str%")
        ->orWhere('notices', 'LIKE', "%$str%")
        ->orWhere('imei', 'LIKE', "%$str%")
        ->orWhere('problem', 'LIKE', "%$str%");
        
      // validate date
      $validator = Validator::make(['search_date' => $str], ['search_date' => 'date']);

      if (!$validator->fails()) {
        $date = Date::parse($str)->format('Y-m-d');
        $query->orWhereDate('created_at', '=', $date);
      }
      return $query;
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
      });
  }
}
