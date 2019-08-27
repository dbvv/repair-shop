<?php
namespace App\ModelFilters;

use Auth;
use EloquentFilter\ModelFilter;

class ClientFilter extends ModelFilter
{
  /**
   * Related Models that have ModelFilters as well as the method on the ModelFilter
   * As [relationMethod => [input_key1, input_key2]].
   *
   * @var array
   */
  public $relations = [];

  public function term($str)
  {
    return $this->where(function ($q) use ($str) {
      return $q->where('name', 'LIKE', "%$str%")
        ->orWhere('phone', 'LIKE', '%$str%')
        ->orWhere('address', 'LIKE', '%$str%');
    });
  }

  public function search($str)
  {
    return $this->where(function ($q) use ($str) {
      return $q->where('name', 'LIKE', "%$str%")
        ->orWhere('phone', 'LIKE', '%$str%')
        ->orWhere('address', 'LIKE', '%$str%');
    });
  }

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
}
