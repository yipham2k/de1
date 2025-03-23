<form action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}"
    method="POST">
    @csrf
    @if (isset($category))
        @method('PUT')
    @endif

    <!-- Hiển thị thông báo lỗi ở đầu form -->
    <x-validation-errors />

    <div class="form-group">
        <label for="name">Tên danh mục</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            value="{{ old('name', isset($category) ? $category->name : '') }}">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
            value="{{ old('slug', isset($category) ? $category->slug : '') }}">
        @error('slug')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Mô tả</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', isset($category) ? $category->description : '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-check">
        <input type="checkbox" class="form-check-input @error('active') is-invalid @enderror" id="active"
            name="active" value="1" {{ old('active', isset($category) && $category->active ? 'checked' : '') }}>
        <label class="form-check-label" for="active">Kích hoạt</label>
        @error('active')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary mt-3">{{ isset($category) ? 'Cập nhật' : 'Tạo mới' }}</button>
</form>
