<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\CheckoutRequest;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Product;

class TransactionController extends Controller
{
  public function checkout(CheckoutRequest $request) {
    $dataTrans = $request->except('product_id', 'quantity');
    $digits = 4;
    $dataTrans['transcode'] = 'TRC-120203'.rand(pow(10, $digits-1), pow(10, $digits)-1);
    $dataTrans['status'] = 'P';
    $createDataTrans = Transaction::create($dataTrans);

    $product_id = $request->product_id;
    $quantity = $request->quantity;

    foreach($product_id as $key=>$item) {
      $details[] = new TransactionDetail([
        'transaction_id' => $createDataTrans->id,
        'product_id' => $item,
        'quantity' => $quantity[$key],
      ]);

      Product::find($item)->decrement('quantity', $quantity[$key]);
    }

    $createDataTrans->detail()->saveMany($details);

    return ResponseFormater::success('success', 'success');
  }
}
