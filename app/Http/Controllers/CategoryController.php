<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Alert;
class CategoryController extends Controller
{
  public function __construct() {
    $this->middleware('auth');
  }

  public function add() {
    return view('pages.category.add');
  }

  public function store(Request $request) {
    $request->validate([
      'name' => 'required|unique:categories|max:20|string'
    ]);

    $name = $request->input('name');

    $category = new Category;
    $category->name = $name;
    $category->save();

    alert()->success('Sukses', 'Tambah Data Kategori Sukses');

    return view('pages.category.add');
  }

  public function data(){
    $data = Category::all();

    return view('pages.category.data')->with([
      'data' => $data,
    ]);
  }

  public function edit($id) {
    $data = Category::findOrFail($id);

    return view('pages.category.edit')->with([
      'data' => $data
    ]);
  }

  public function save(Request $request, $id) {
    $request->validate([
      'name' => 'required|unique:categories|max:20|nullable'
    ]);

    $name = $request->input('name');

    $data = Category::findOrFail($id);
    $data->name = $name;
    $data->save();
    alert()->success('Sukses', 'Perubahan Data Kategori Sukses');

    return redirect()->route('category-data');
  }

  public function delete($id) {
    $data = Category::findOrFail($id);
    $data->delete();
    alert()->success('Sukses', 'Hapus Data Kategori Sukses');

    return redirect()->route('category-data');
  }
}
