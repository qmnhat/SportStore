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
        Schema::create('YeuThich', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('MaKH');
            $table->unsignedInteger('MaSP');
            $table->timestamps();

            $table->unique(['MaKH', 'MaSP']);

            $table->foreign('MaKH')->references('MaKH')->on('KhachHang')->onDelete('cascade');
            $table->foreign('MaSP')->references('MaSP')->on('SanPham')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yeu_thich');
    }
};
