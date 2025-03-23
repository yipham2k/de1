<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
  /**
   * Hiển thị chi tiết sản phẩm theo slug
   */
  public function show($slug)
  {
    $product = Product::with(['category', 'images'])->where('slug', $slug)->where('active', 1)->firstOrFail();

    // Lấy sản phẩm liên quan (cùng danh mục)
    $relatedProducts = Product::where('category_id', $product->category_id)
      ->where('id', '!=', $product->id)
      ->where('active', 1)
      ->take(4)
      ->get();

    return view('products.detail.show', compact('product', 'relatedProducts'));
  }

  /**
   * Hiển thị chi tiết sản phẩm theo ID
   */
  public function showById($id)
  {
    $product = Product::with(['category', 'images'])->where('id', $id)->where('active', 1)->firstOrFail();

    // Chuyển hướng đến URL sử dụng slug để SEO tốt hơn
    return redirect()->route('products.detail', $product->slug);
  }

  /**
   * API lấy thông tin sản phẩm
   */
  public function getProductInfo($id)
  {
    $product = Product::with(['category', 'images'])->findOrFail($id);

    return response()->json([
      'product' => $product,
      'formatted_price' => number_format($product->current_price) . '₫',
      'formatted_original_price' => $product->original_price ? number_format($product->original_price) . '₫' : null,
      'discount_percent' => $product->original_price ? round((1 - $product->current_price / $product->original_price) * 100) : 0,
    ]);
  }
}
