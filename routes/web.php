<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
  return view('welcome');
});

Route::get('/food', function () {
  return view('food');
});

// Route quản lý danh mục
Route::resource('categories', CategoryController::class);

// Route quản lý sản phẩm
Route::resource('products', ProductController::class);

// Route quản lý hình ảnh sản phẩm
Route::resource('product-images', ProductImageController::class);

// Route Dashboard quản trị
Route::get('/admin', function () {
  return view('admin.dashboard');
})->name('admin.dashboard');

// Route hiển thị chi tiết sản phẩm theo slug
Route::get('/product/{slug}', [ProductDetailController::class, 'show'])->name('products.detail');

// Route hiển thị chi tiết sản phẩm theo ID (để tương thích với hệ thống cũ nếu có)
Route::get('/product/id/{id}', [ProductDetailController::class, 'showById'])->name('products.detail.id');

// Route API lấy thông tin sản phẩm (cho AJAX)
Route::get('/api/product/{id}', [ProductDetailController::class, 'getProductInfo'])->name('api.product');


Route::get('/products/detail', function () {
  return view('products.detail');
});

Route::get('/nhoxanh/deital', function () {
  return view('nhoxanh.deital');
});

Route::get('/mungtoi/deital', function () {
  return view('mungtoi.deital');
});

Route::get('/camcaophong/deital', function () {
  return view('camcaophong.deital');
});

Route::get('/cachua/deital', function () {
  return view('cachua.deital');
});

Route::get('/boxanh/deital', function () {
  return view('boxanh.deital');
});

Route::get('/bingo/deital', function () {
  return view('bingo.deital');
});

Route::get('/cuden/deital', function () {
  return view('cuden.deital');
});

Route::get('/dua/deital', function () {
  return view('dua.deital');
});

// Route tìm kiếm sản phẩm
Route::get('/search', [SearchController::class, 'search'])->name('search');
