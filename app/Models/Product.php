<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $table = "products";

  protected $fillable = [
    'name',
    'quantity',
    'category_id',
    'price',
    'description'
  ];

  public function getCategory() {
    return $this->belongsTo('App\Models\Category', 'category_id', 'id');
  }

  public function setProduct() {
    return $this->hasMany('App\Models\GalleryProduct', 'product_id');
  }

  public function setProductTrans() {
    return $this->hasOne('App\Models\TransactionDetail', 'product_id');
  }
}
