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
        Schema::create('company_policies', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'shipping', 'payment', 'return'
            $table->text('title'); // Tên chính sách
            $table->text('content'); // Nội dung chi tiết
            $table->integer('order')->default(0); // Thứ tự
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_policies');
    }
};
