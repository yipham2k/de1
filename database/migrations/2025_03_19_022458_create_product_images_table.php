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
    Schema::create('product_images', function (Blueprint $table) {
      $table->id();
      $table->foreignId('product_id')->constrained()->onDelete('cascade');
      $table->string('image_path');
      $table->boolean('is_main')->default(false); //cột này để xem thử đây có phải là ảnh chính không (em thêm vào để cho nó đầu đặn database)
      $table->integer('display_order')->default(0); //thứ tự hiển thị hình ảnh (cột này cũng như cột trên)
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('product_images');
  }
};
