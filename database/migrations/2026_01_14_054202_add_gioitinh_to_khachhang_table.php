<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('KhachHang', function (Blueprint $table) {
            $table->unsignedTinyInteger('GioiTinh')
                ->nullable()
                ->after('NgaySinh');
            // 0: Nữ, 1: Nam (quy ước)
        });
    }

    public function down(): void
    {
        Schema::table('KhachHang', function (Blueprint $table) {
            $table->dropColumn('GioiTinh');
        });
    }
};
