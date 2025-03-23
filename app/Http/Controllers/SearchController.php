<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
  public function search(Request $request)
  {
    // Lấy từ khóa từ request
    $keyword = $request->input('keyword');

    // Validate từ khóa
    if (empty($keyword)) {
      return redirect()->back()->with('error', 'Vui lòng nhập từ khóa tìm kiếm');
    }

    try {
      // Tìm kiếm sản phẩm trực tiếp từ DB để đảm bảo kết nối
      $products = DB::table('products')
        ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
        ->select(
          'products.*',
          'categories.name as category_name',
          'categories.slug as category_slug'
        )
        ->where('products.active', 1)
        ->where(function ($query) use ($keyword) {
          $query->where('products.name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('products.description', 'LIKE', '%' . $keyword . '%')
            ->orWhere('categories.name', 'LIKE', '%' . $keyword . '%');
        })
        ->get();

      // Trả về view tự tạo đơn giản nếu view results không tồn tại
      if (!view()->exists('search.results')) {
        return response()->view('search_results', compact('products', 'keyword'));
      }

      return view('search.results', compact('products', 'keyword'));
    } catch (\Exception $e) {
      // Ghi log lỗi
      // \Log::error('Search error: ' . $e->getMessage());

      // Tạo view kết quả tìm kiếm trực tiếp nếu có lỗi
      return response()->view('search_results', [
        'products' => [],
        'keyword' => $keyword,
        'error' => 'Đã xảy ra lỗi khi tìm kiếm: ' . $e->getMessage()
      ]);
    }
  }
}
