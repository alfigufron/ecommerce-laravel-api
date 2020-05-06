<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ClientController extends Controller
{
  public function home() {
    return view('client.home');
  }

  public function catalog() {
    return view('client.catalog');
  }

  public function detail() {
    return view('client.detail');
  }

  public function cart() {
    return view('client.cart');
  }
}
