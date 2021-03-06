<?php
namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class BrandFilter extends ModelFilter
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
  }

  public function search($str)
  {
    return $this->where(function ($q) use ($str) {
      return $q->where('name', 'LIKE', "%$str%");
    });
  }
}
