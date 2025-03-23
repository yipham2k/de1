<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Hiển thị form tạo sản phẩm mới
     */
    public function create()
    {
        $categories = Category::where('active', true)->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Lưu sản phẩm mới vào database
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        // Tạo slug nếu không được cung cấp
        if (!isset($data['slug']) || empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Xử lý checkbox active
        $data['active'] = $request->has('active');

        // Xử lý upload hình ảnh nếu có
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = Str::slug($data['name']) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            $data['image'] = 'uploads/products/' . $filename;
        }

        Product::create($data);

        return redirect()->route('products.index')
            ->with('success', 'Sản phẩm đã được tạo thành công.');
    }

    /**
     * Hiển thị thông tin sản phẩm
     */
    public function show(Product $product)
    {
        $product->load('category');
        return view('admin.products.show', compact('product'));
    }

    /**
     * Hiển thị form sửa sản phẩm
     */
    public function edit(Product $product)
    {
        $categories = Category::where('active', true)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Cập nhật sản phẩm trong database
     */
    public function update(Request $request, Product $product)
    {
        // Debug dữ liệu
        // dd($request->all());
        // dòng trên được đẻ ra là để debug dữ liệu được gửi lên khi cập nhật sản phẩmphẩm

        // Validate dữ liệu đầu vào
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'description' => 'nullable|string',
            'current_price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // Cập nhật từng trường một
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->current_price = $request->current_price;
        $product->original_price = $request->original_price;
        $product->stock = $request->stock;
        $product->active = $request->has('active') ? 1 : 0;

        // Xử lý upload hình ảnh
        if ($request->hasFile('image_file')) {
            // Xóa ảnh cũ nếu có
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $file = $request->file('image_file');
            $filename = Str::slug($request->name) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            $product->image = 'uploads/products/' . $filename;
        }

        // Lưu vào database
        $product->save();

        return redirect()->route('products.index')
            ->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }

    /**
     * Xóa sản phẩm khỏi database
     */
    public function destroy(Product $product)
    {
        // Xóa ảnh sản phẩm nếu có
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Sản phẩm đã được xóa thành công.');
    }
}
