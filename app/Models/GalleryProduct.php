<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryProduct extends Model
{
  protected $table = "gallery_products";

  protected $fillable = [
    'product_id',
    'photo',
    'default',
  ];

  public function getProduct() {
    return $this->belongsTo('App\Models\Product', 'product_id', 'id');
  }
}
