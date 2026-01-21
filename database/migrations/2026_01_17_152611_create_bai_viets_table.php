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
            $table->text('TomTat')->nullable();
            $table->unsignedBigInteger('MaDanhMuc')->nullable();
            $table->unsignedInteger('NguoiTao')->nullable();
            $table->integer('LuotXem')->default(0);
            $table->unsignedTinyInteger('TrangThai')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('NguoiTao')->references('MaQL')->on('NhaQuanLy')->onDelete('set null');
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
