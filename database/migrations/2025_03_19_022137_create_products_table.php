<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('products', function (Blueprint $table) {
      $table->id();
      $table->foreignId('category_id')->constrained()->onDelete('cascade');
      $table->string('name'); // Tên sản phẩm: NHO XANH, MÙNG TƠI, DỨA, CỦ DỀN...
      $table->string('slug')->unique(); // Slug URL
      $table->text('description')->nullable(); // Mô tả chi tiết
      $table->decimal('current_price', 12, 0); // Giá hiện tại (12,000)
      $table->decimal('original_price', 12, 0)->nullable(); // Giá gốc (15,000)
      $table->string('image')->nullable(); // Đường dẫn hình ảnh
      $table->boolean('active')->default(true); // Trạng thái
      $table->integer('stock')->default(0); // Số lượng tồn kho
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('products');
  }
};
