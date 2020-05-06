<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\GalleryProduct;

class ProductController extends Controller
{
  public function all(Request $request) {
    $id = $request->input('id');
    $limit = $request->input('limit');
    $status = $request->input('status');

    if($id) {
      $dataProduct = Product::with('setProduct')->with('getCategory')
        ->find($id);

      if($dataProduct){
        return ResponseFormater::success($dataProduct, 'success');
      }else{
        return ResponseFormater::error(null, 'not found', 404);
      }
    }

    if($limit) {
      $dataProduct = Product::with('setProduct')->with('getCategory')
        ->take($limit)
        ->get();
      if($dataProduct){
        return ResponseFormater::success($dataProduct, 'success');
      }else{
        return ResponseFormater::error(null, 'not found', 404);
      }
    }

    if($status == 'new') {
      $dataProduct = Product::with('setProduct')->with('getCategory')
        ->orderBy('created_at', 'desc')
        ->take(6)
        ->get();
      if($dataProduct){
        return ResponseFormater::success($dataProduct, 'success');
      }else{
        return ResponseFormater::error(null, 'not found', 404);
      }
    }

    $dataProduct = Product::with('setProduct')->with('getCategory')
      ->get();

    if($dataProduct){
      return ResponseFormater::success($dataProduct, 'success');
    }else{
      return ResponseFormater::error(null, 'not found', 404);
    }
  }
}
