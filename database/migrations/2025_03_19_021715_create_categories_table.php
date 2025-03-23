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
    Schema::create('categories', function (Blueprint $table) {
      $table->id();
      $table->string('name'); // Tên danh mục (HOA QUẢ, THỰC PHẨM KHÔ, RAU HỮU CƠ)
      $table->string('slug')->unique(); // Slug dùng cho URL
      $table->text('description')->nullable(); // Mô tả (nếu cần)
      $table->boolean('active')->default(true); // Trạng thái
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('categories');
  }
};
