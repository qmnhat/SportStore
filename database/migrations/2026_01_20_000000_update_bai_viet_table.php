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
        // Cập nhật table BaiViet
        Schema::table('BaiViet', function (Blueprint $table) {
            // Kiểm tra và thêm các cột nếu chưa tồn tại
            if (!Schema::hasColumn('BaiViet', 'LuotXem')) {
                $table->integer('LuotXem')->default(0)->after('slug');
            }
            if (!Schema::hasColumn('BaiViet', 'MaDanhMuc')) {
                $table->unsignedBigInteger('MaDanhMuc')->nullable()->after('TomTat');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('BaiViet', function (Blueprint $table) {
            if (Schema::hasColumn('BaiViet', 'LuotXem')) {
                $table->dropColumn('LuotXem');
            }
            if (Schema::hasColumn('BaiViet', 'MaDanhMuc')) {
                $table->dropColumn('MaDanhMuc');
            }
        });
    }
};
