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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('status_id');
            $table->string('name', 255)->nullable();
            $table->string('email', 255)->unique();
            $table->string('code', 255)->nullable();
            $table->string('password', 255);
            $table->string('image', 255)->nullable();
            $table->integer('role')->default(1); // 1-Admin, 2-Lễ tân, 3-Quản lý, 4-Khách hàng
            $table->string('phone', 20)->nullable();
            $table->string('address', 255)->nullable();
            $table->timestamp('create_at')->useCurrent();
            $table->timestamp('update_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
