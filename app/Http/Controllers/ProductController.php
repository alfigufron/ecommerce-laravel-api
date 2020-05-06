<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\GalleryProduct;

use File;

class ProductController extends Controller
{
  public function __construct() {
    $this->middleware('auth');
  }

  public function add() {
    $categoryData = Category::all();

    return view('pages.product.add')->with([
      'categoryData' => $categoryData
    ]);
  }

  public function store(ProductRequest $request) {
    $data = [
      'name' => $request->input('name'),
      'quantity' => $request->input('quantity'),
      'category_id' => $request->input('category_id'),
      'price' => $request->input('price'),
      'description' => $request->input('description'),
    ];

    Product::create($data);
    alert()->success('Sukses', 'Tambah Data Produk Sukses');

    return redirect()->route('add-product');
  }
  
  public function data() {
    $data = Product::all();

    foreach($data as $key=>$item) {
      $price = $item->price;

      $price = number_format($price, 0, ',', '.');
      $data[$key]['price'] = $price;
    }

    return view('pages.product.data')->with([
      'data' => $data
    ]);
  }
  
  public function edit($id) {
    $data = Product::findOrFail($id);
    $categoryData = Category::all();

    return view('pages.product.edit')->with([
      'data' => $data,
      'categoryData' => $categoryData
    ]);
  }

  public function save(ProductRequest $request, $id) {
    $data = Product::findOrFail($id);
    $data->name = $request->input('name');
    $data->quantity = $request->input('quantity');
    $data->category_id = $request->input('category_id');
    $data->price = $request->input('price');
    $data->description = $request->input('description');
    $data->save();
    alert()->success('Sukses', 'Ubah Data Produk Sukses');

    return redirect()->route('product-data');
  }

  public function delete($id) {
    $data = Product::findOrFail($id);
    $galleryData = GalleryProduct::all()->where('product_id', $id);

    foreach($galleryData as $item) {
      File::delete(public_path($item->photo));
      $item->delete();
    }

    $data->delete();
    alert()->success('Sukses', 'Hapus Data Produk Sukses');

    return redirect()->route('product-data');
  }
}
