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
        Schema::create('bai_viet_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('MaBV');
            $table->unsignedBigInteger('NguoiDung')->nullable();
            $table->text('NoiDung');
            $table->unsignedTinyInteger('XepHang')->default(5); // 1-5 sao
            $table->unsignedTinyInteger('TrangThai')->default(0); // 0: chờ duyệt, 1: đã duyệt
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('MaBV')->references('MaBV')->on('BaiViet')->onDelete('cascade');
            $table->foreign('NguoiDung')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bai_viet_comments');
    }
};
