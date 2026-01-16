<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ThongKeSanPham', function (Blueprint $table) {
            $table->unsignedInteger('MaSP')->primary();
            $table->integer('LuotXem')->default(0);
            $table->integer('LuotYeuThich')->default(0);

            $table->foreign('MaSP')->references('MaSP')->on('SanPham');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ThongKeSanPham');
    }
};
