<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
  public function __construct() {
    $this->middleware('auth');
  }

  public function dashboard(Request $request) {
    $name = auth()->user()->name;
    $request->session()->put('name', $name);

    return view('pages.dashboard');
  }
}
