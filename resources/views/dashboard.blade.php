@extends('layouts.admin')

@section('title', 'Dashboard - Quản lý Food Store')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Dashboard</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Danh mục</h5>
                    <h2>{{ \App\Models\Category::count() }}</h2>
                    <a href="{{ route('categories.index') }}" class="btn btn-light mt-3">Quản lý danh mục</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Sản phẩm</h5>
                    <h2>{{ \App\Models\Product::count() }}</h2>
                    <a href="{{ route('products.index') }}" class="btn btn-light mt-3">Quản lý sản phẩm</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Hình ảnh</h5>
                    <h2>{{ \App\Models\ProductImage::count() }}</h2>
                    <a href="{{ route('product-images.index') }}" class="btn btn-light mt-3">Quản lý hình ảnh</a>
                </div>
            </div>
        </div>
    </div>
@endsection
