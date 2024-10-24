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
        Schema::create('gmail_setting', function (Blueprint $table) {
            $table->id();
            $table->integer('status_id'); // Trạng thái của gmail
            $table->string('content', 255); // Nội dung
            $table->integer('type'); // Phân biệt từng nội dung
            $table->timestamp('create_at')->useCurrent(); // Thời gian tạo
            $table->timestamp('update_at')->useCurrent()->useCurrentOnUpdate(); // Thời gian cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gmail_settings');
    }
};
