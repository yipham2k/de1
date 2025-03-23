<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
  /**
   * Hiển thị danh sách danh mục
   */
  public function index()
  {
    $categories = Category::all();
    return view('admin.categories.index', compact('categories'));
  }

  /**
   * Hiển thị form tạo danh mục mới
   */
  public function create()
  {
    return view('admin.categories.create');
  }

  /**
   * Lưu danh mục mới vào database
   */
  public function store(CategoryRequest $request)
  {
    $data = $request->validated();

    // Tạo slug nếu không được cung cấp
    if (!isset($data['slug']) || empty($data['slug'])) {
      $data['slug'] = Str::slug($data['name']);
    }

    // Xử lý checkbox active
    $data['active'] = $request->has('active');

    Category::create($data);

    return redirect()->route('categories.index')
      ->with('success', 'Danh mục đã được tạo thành công.');
  }

  /**
   * Hiển thị thông tin danh mục
   */
  public function show(Category $category)
  {
    return view('admin.categories.show', compact('category'));
  }

  /**
   * Hiển thị form sửa danh mục
   */
  public function edit(Category $category)
  {
    return view('admin.categories.edit', compact('category'));
  }

  /**
   * Cập nhật danh mục trong database
   */
  public function update(CategoryRequest $request, Category $category)
  {
    $data = $request->validated();

    // Tạo slug nếu không được cung cấp
    if (!isset($data['slug']) || empty($data['slug'])) {
      $data['slug'] = Str::slug($data['name']);
    }

    // Xử lý checkbox active
    $data['active'] = $request->has('active');

    $category->update($data);

    return redirect()->route('categories.index')
      ->with('success', 'Danh mục đã được cập nhật thành công.');
  }

  /**
   * Xóa danh mục khỏi database
   */
  public function destroy(Category $category)
  {
    $category->delete();

    return redirect()->route('categories.index')
      ->with('success', 'Danh mục đã được xóa thành công.');
  }
}
