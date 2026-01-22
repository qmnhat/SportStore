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
        Schema::table('BaiViet', function (Blueprint $table) {
            // Bỏ cột IsDeleted cũ nếu tồn tại
            if (Schema::hasColumn('BaiViet', 'IsDeleted')) {
                $table->dropColumn('IsDeleted');
            }
            if (!Schema::hasColumn('BaiViet', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('BaiViet', function (Blueprint $table) {
            if (!Schema::hasColumn('BaiViet', 'IsDeleted')) {
                $table->boolean('IsDeleted')->default(false);
            }
        });
    }
};
