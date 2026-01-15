<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ThongSoSanPham', function (Blueprint $table) {
            $table->increments('MaTS');
            $table->unsignedInteger('MaSP');
            $table->string('TenTS', 150);   
            $table->string('GiaTri', 255);    
            $table->integer('SapXep')->default(0);

            $table->foreign('MaSP')->references('MaSP')->on('SanPham');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ThongSoSanPham');
    }
};
