<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
  protected $fillable = [
    'transaction_id',
    'product_id',
    'quantity'
  ];

  public function getProduct() {
    return $this->belongsTo('App\Models\Product', 'product_id', 'id');
  }

  public function transaction() {
    return $this->belongsTo('App\Models\Transaction', 'transaction_id', 'id');
  }
}
