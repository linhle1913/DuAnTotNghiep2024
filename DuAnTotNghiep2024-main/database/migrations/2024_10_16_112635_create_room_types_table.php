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
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('type', 255); // Tên loại phòng
            $table->integer('defaul_people'); // Số người mặc định
            $table->integer('price_per_night'); // Giá 1 đêm
            $table->text('description')->nullable(); // Mô tả ngắn
            $table->text('description_details')->nullable(); // Chi tiết mô tả
            $table->string('title', 255); // Tiêu đề cho loại phòng
            $table->timestamp('create_at')->useCurrent(); // Thời gian tạo
            $table->timestamp('update_at')->useCurrent()->useCurrentOnUpdate(); // Thời gian cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_types');
    }
};
