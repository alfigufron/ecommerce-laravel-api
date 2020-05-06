<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Product;

class TransactionController extends Controller
{
  public function data() {
    $data = Transaction::all();

    return view('pages.transaction.data')->with([
      'data' => $data
    ]);
  }

  public function detail($id) {
    $data = Transaction::findOrFail($id);
    $detailTransData = TransactionDetail::where('transaction_id', $data->id)
    ->get();

    $totalPrice = [];
    
    foreach($detailTransData as $key=>$item) {
      $price = $item->getProduct->price;
      $quantity = $item->quantity;
      $total = $price*$quantity;

      $totalPrice[] = $total;

      $total = number_format($total, 0, ',', '.');
      $detailTransData[$key]['total'] = $total;
      
      $price = number_format($price, 0, ',', '.');
      $detailTransData[$key]['price'] = $price;
    }

    $totalPrice = array_sum($totalPrice);
    $totalPrice = number_format($totalPrice, 0, ',', '.');

    return view('pages.transaction.detail')->with([
      'data' => $data,
      'detail' => $detailTransData,
      'total' => $totalPrice
    ]);
  }

  public function success($id) {
    $data = Transaction::findOrFail($id);
    $data->status = "S";
    $data->save();

    alert()->success('Sukses', 'Berhasil mengubah status transaksi menjadi sukses');
    return redirect()->route('transaction-data');
  }

  public function pending($id) {
    $data = Transaction::findOrFail($id);
    $data->status = "P";
    $data->save();

    alert()->success('Sukses', 'Berhasil mengubah status transaksi menjadi pending');
    return redirect()->route('transaction-data');
  }

  public function reject($id) {
    $data = Transaction::findOrFail($id);
    $detailTransData = TransactionDetail::where('transaction_id', $data->id)
      ->get();

    foreach($detailTransData as $item) {
      $product_id = $item->product_id;
      $quantity = $item->quantity;

      $productData = Product::findOrFail($product_id);
      $productData->quantity = ($productData->quantity)+$quantity;
      $productData->save();
    }
    
    $data->status = "R";
    $data->save();

    alert()->success('Sukses', 'Berhasil mengubah status transaksi menjadi batal');
    return redirect()->route('transaction-data');
  }
}
