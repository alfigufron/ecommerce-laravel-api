<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\GalleryProduct;

use File;

class GalleryController extends Controller
{
  public function add() {
    $productData = Product::all();

    return view('pages.product.gallery.add')->with([
      'productData' => $productData
    ]);
  }

  public function data() {
    $galleryData = GalleryProduct::all();

    return view('pages.product.gallery.data')->with([
      'galleryData' => $galleryData
    ]);
  }

  public function store(Request $request) {
    $productId = $request->productId;
    $image_file = $request->image;
    $isDefault = $request->isDefault;
    
    list($type, $image_file) = explode(';', $image_file);
    list(, $image_file)      = explode(',', $image_file);
    $image_file = base64_decode($image_file);

    $image_name= time().mt_rand(100,999).'.png';
    $path = public_path('uploads/products/'.$image_name);
    file_put_contents($path, $image_file);

    $photo = 'uploads/products/'.$image_name;

    $gallery = new GalleryProduct;
    $gallery->product_id = $productId;
    $gallery->photo = $photo;
    $gallery->default = $isDefault;
    $gallery->save();

    return response()->json(['status'=>200]);
  }

  public function delete($id) {
    $data = GalleryProduct::findOrFail($id);

    File::delete(public_path($data->photo));
    $data->delete();
    alert()->success('Sukses', 'Hapus Gambar Produk Sukses');

    return redirect()->route('gallery-data');
  }
}
