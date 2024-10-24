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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->integer('room_type_id'); // ID loại phòng
            $table->integer('room_statuses_id'); // Trạng thái phòng
            $table->integer('number'); // Số phòng
            $table->text('description')->nullable(); // Mô tả phòng
            $table->timestamp('create_at')->useCurrent(); // Thời gian tạo
            $table->timestamp('update_at')->useCurrent()->useCurrentOnUpdate(); // Thời gian cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
