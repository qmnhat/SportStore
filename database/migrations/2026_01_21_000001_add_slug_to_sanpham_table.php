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
        Schema::table('SanPham', function (Blueprint $table) {
            $table->string('slug', 250)->nullable()->unique()->after('TenSP');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('SanPham', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
