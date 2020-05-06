<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return redirect()->route('home-client');
});

Route::get('/admin', function () {
  return redirect('/admin/login');
});

Route::get('home', 'ClientController@home')
  ->name('home-client');
  Route::get('catalog', 'ClientController@catalog')
  ->name('catalog-client');
  Route::get('cart', 'ClientController@cart')
  ->name('cart-client');
Route::get('detail', 'ClientController@detail')
->name('detail-client');

Route::prefix('admin')->group(function() {
  Auth::routes(['register' => false]);
  
  Route::get('dashboard', 'AdminController@dashboard')
    ->name('dashboard');

  // Product Page
  Route::prefix('product')->group(function() {
    // Product
    Route::get('add', 'ProductController@add')
      ->name('add-product');
    Route::post('store', 'ProductController@store')
      ->name('store-product');
    Route::get('data', 'ProductController@data')
      ->name('product-data');
    Route::get('edit/{id}', 'ProductController@edit')
      ->name('edit-product');
    Route::put('save/{id}', 'ProductController@save')
      ->name('save-product');
    Route::delete('delete/{id}', 'ProductController@delete')
      ->name('delete-product');

    // Gallery
    Route::prefix('gallery')->group(function(){
      Route::get('add', 'GalleryController@add')
        ->name('add-gallery');
      Route::get('data', 'GalleryController@data')
        ->name('gallery-data');
      Route::post('store', 'GalleryController@store')
        ->name('store-gallery');
      Route::delete('delete/{id}', 'GalleryController@delete')
        ->name('delete-gallery');
    });
  });

  // Transaction Page
  Route::prefix('transaction')->group(function() {
    Route::get('data', 'TransactionController@data')
      ->name('transaction-data');
    Route::get('detail/{id}', 'TransactionController@detail')
      ->name('detail-transaction-data');

    Route::prefix('process')->group(function() {
      Route::post('success/{id}', 'TransactionController@success')
        ->name('transaction-success');
      Route::post('pending/{id}', 'TransactionController@pending')
        ->name('transaction-pending');
      Route::post('reject/{id}', 'TransactionController@reject')
        ->name('transaction-reject');
    });
  });

  // Category Page
  Route::prefix('category')->group(function() {
    Route::get('add', 'CategoryController@add')
      ->name('add-category');
    Route::post('store', 'CategoryController@store')
      ->name('store-category');
    Route::get('data', 'CategoryController@data')
      ->name('category-data');
    Route::get('edit/{id}', 'CategoryController@edit')
      ->name('edit-category');
    Route::put('save/{id}', 'CategoryController@save')
      ->name('save-category');
    Route::delete('delete/{id}', 'CategoryController@delete')
      ->name('delete-category');
  });
});


