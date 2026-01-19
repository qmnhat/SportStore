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

        Schema::create('BaiViet', function (Blueprint $table) {
            $table->increments('MaBV');
            $table->string('TieuDe', 200);
            $table->string('slug', 250)->unique();
            $table->longText('NoiDung');
            $table->string('HinhAnh', 255)->nullable();
            $table->text('TomTat')->nullable();  // Mô tả ngắn
            $table->unsignedBigInteger('NguoiTao')->nullable();
            $table->dateTime('NgayTao')->useCurrent();
            $table->dateTime('NgayCapNhat')->useCurrent()->useCurrentOnUpdate();
            $table->unsignedTinyInteger('TrangThai')->default(1);  // 1: Công khai, 0: Draft
            $table->boolean('IsDeleted')->default(false);
            $table->dateTime('DeletedAt')->nullable();

            $table->foreign('NguoiTao')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('BaiViet');
    }
};
