<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index()
  {
    // Lấy 8 sản phẩm nổi bật (các sản phẩm có giảm giá)
    $featuredProducts = Product::where('active', 1)
      ->whereNotNull('original_price')
      ->orderBy('id', 'desc')
      ->take(8)
      ->get();

    return view('food', compact('featuredProducts'));
  }
}
