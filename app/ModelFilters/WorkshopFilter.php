<?php

namespace App\ModelFilters;

use Auth;
use EloquentFilter\ModelFilter;

class WorkshopFilter extends ModelFilter
{
  /**
   * Related Models that have ModelFilters as well as the method on the ModelFilter
   * As [relationMethod => [input_key1, input_key2]].
   *
   * @var array
   */
  public $relations = [];

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
      return $q->where('name', 'LIKE', "%$str%");
    });
  }
}
