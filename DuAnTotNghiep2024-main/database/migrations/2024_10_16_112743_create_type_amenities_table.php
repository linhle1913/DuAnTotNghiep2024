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
        Schema::create('type_amenities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255); // Tên loại tiện nghi
            $table->text('description'); // Mô tả tiện nghi
            $table->timestamp('create_at')->useCurrent(); // Thời gian tạo
            $table->timestamp('update_at')->useCurrent()->useCurrentOnUpdate(); // Thời gian cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_amenities');
    }
};
