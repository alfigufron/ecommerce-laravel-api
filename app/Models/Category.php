<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $table = 'categories';

  protected $fillable = ['name'];

  public function setCategory() {
    return $this->hasOne('App\Models\Product', 'category_id');
  }
}
