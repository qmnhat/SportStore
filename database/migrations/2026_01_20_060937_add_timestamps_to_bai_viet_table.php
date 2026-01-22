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
            if (Schema::hasColumn('BaiViet', 'created_at')) {
                $table->renameColumn('created_at', 'NgayTao');
            }
            if (Schema::hasColumn('BaiViet', 'updated_at')) {
                $table->renameColumn('updated_at', 'NgayCapNhat');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('BaiViet', function (Blueprint $table) {
            if (Schema::hasColumn('BaiViet', 'NgayTao')) {
                $table->renameColumn('NgayTao', 'created_at');
            }
            if (Schema::hasColumn('BaiViet', 'NgayCapNhat')) {
                $table->renameColumn('NgayCapNhat', 'updated_at');
            }
        });
    }
};
