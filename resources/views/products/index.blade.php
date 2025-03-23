@extends('layouts.admin')

@section('title', 'Quản lý sản phẩm')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Quản lý sản phẩm</h1>
        <a href="{{ route('products.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-1"></i> Thêm sản phẩm mới
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Giá hiện tại</th>
                            <th>Giá gốc</th>
                            <th>Trạng thái</th>
                            <th>Tồn kho</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if ($product->image)
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="50">
                                    @else
                                        <span class="text-muted">Không có ảnh</span>
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? 'N/A' }}</td>
                                <td>{{ number_format($product->current_price) }} ₫</td>
                                <td>
                                    @if ($product->original_price)
                                        {{ number_format($product->original_price) }} ₫
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($product->active)
                                        <span class="badge bg-success">Kích hoạt</span>
                                    @else
                                        <span class="badge bg-danger">Vô hiệu</span>
                                    @endif
                                </td>
                                <td>{{ $product->stock }}</td>
                                <td class="text-center">
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info"
                                        title="Xem">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-primary"
                                        title="Sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')"
                                            title="Xóa">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Không có sản phẩm nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
