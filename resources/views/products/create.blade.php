@extends('layouts.admin')

@section('title', 'Thêm sản phẩm mới')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Thêm sản phẩm mới</h1>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Quay lại
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Hiển thị thông báo lỗi ở đầu form -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Danh mục <span class="text-danger">*</span></label>
                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id"
                                name="category_id" required>
                                <option value="">-- Chọn danh mục --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                name="slug" value="{{ old('slug') }}">
                            <div class="form-text">Để trống để tự động tạo từ tên.</div>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="current_price" class="form-label">Giá hiện tại <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control @error('current_price') is-invalid @enderror"
                                    id="current_price" name="current_price" value="{{ old('current_price') }}"
                                    min="0" required>
                                <span class="input-group-text">₫</span>
                                @error('current_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="original_price" class="form-label">Giá gốc</label>
                            <div class="input-group">
                                <input type="number" class="form-control @error('original_price') is-invalid @enderror"
                                    id="original_price" name="original_price" value="{{ old('original_price') }}"
                                    min="0">
                                <span class="input-group-text">₫</span>
                                @error('original_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Tồn kho <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock"
                                name="stock" value="{{ old('stock', 0) }}" min="0" required>
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image_file" class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control @error('image_file') is-invalid @enderror"
                                id="image_file" name="image_file">
                            <div class="form-text">Chấp nhận các định dạng: JPG, PNG, GIF.</div>
                            @error('image_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input @error('active') is-invalid @enderror"
                                id="active" name="active" value="1" {{ old('active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="active">Kích hoạt</label>
                            @error('active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
            </form>
        </div>
    </div>
@endsection
@endsection
