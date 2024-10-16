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
        Schema::create('room_statuses', function (Blueprint $table) {
            $table->id();
            $table->integer('room_id'); // ID phòng
            $table->integer('status_id'); // Trạng thái của phòng
            $table->text('description')->nullable(); // Mô tả tình trạng cụ thể nếu phòng bị hỏng
            $table->integer('user_id'); // ID người báo cáo tình trạng phòng
            $table->timestamps(); // Thời gian tạo và cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_statuses');
    }
};
