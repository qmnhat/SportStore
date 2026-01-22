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
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('TenDanhMuc', 200)->unique();
            $table->string('slug', 250)->unique();
            $table->text('MoTa')->nullable();
            $table->unsignedTinyInteger('TrangThai')->default(1);
            $table->timestamps();
        });

        // Thêm foreign key vào BaiViet
        Schema::table('BaiViet', function (Blueprint $table) {
            $table->foreign('MaDanhMuc')->references('id')->on('blog_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('BaiViet', function (Blueprint $table) {
            $table->dropForeign(['MaDanhMuc']);
        });
        Schema::dropIfExists('blog_categories');
    }
};
