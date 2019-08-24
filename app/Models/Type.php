<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
  use SoftDeletes, Filterable;
  protected $fillable = ['name', 'parent_id'];
}
