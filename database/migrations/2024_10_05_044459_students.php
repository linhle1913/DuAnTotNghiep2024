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
       Schema::create('student', function ( Blueprint $table) {
        $table->id();
        $table->string('name',100);
        $table->enum('gender',['nam','nữ']);
        $table->string('tel',15);
        $table->string('address',255);
        $table->string('image',255)->nullable();
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
