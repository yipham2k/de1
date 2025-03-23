@extends('layouts.admin')

@section('title', 'Quản lý danh mục')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Quản lý danh mục</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-1"></i> Thêm danh mục
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Tên danh mục</th>
                            <th>Slug</th>
                            <th>Trạng thái</th>
                            <th>Số sản phẩm</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    @if ($category->active)
                                        <span class="badge bg-success">Kích hoạt</span>
                                    @else
                                        <span class="badge bg-danger">Vô hiệu</span>
                                    @endif
                                </td>
                                <td>{{ $category->products ? $category->products->count() : 0 }}</td>
                                <td class="text-center">
                                    <a href="{{ route('categories.show', $category) }}" class="btn btn-sm btn-info"
                                        title="Xem">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-primary"
                                        title="Sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')"
                                            title="Xóa">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Không có danh mục nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
