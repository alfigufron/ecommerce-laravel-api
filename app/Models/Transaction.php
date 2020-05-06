<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  protected $fillable = [
    'transcode',
    'transdate',
    'name',
    'email',
    'phone',
    'address',
    'transtotal',
    'status'
  ];

  public function detail() {
    return $this->hasMany('App\Models\TransactionDetail', 'transaction_id');
  }
}
