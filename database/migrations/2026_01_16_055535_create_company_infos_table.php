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
        Schema::create('company_infos', function (Blueprint $table) {
            $table->id();
            $table->string('name');//ten cty
            $table->text('description')->nullable();//mo ta cty với null
            $table->text('address');//dia chi
            $table->string('hotline');//số điện thoại
            $table->string('email');//email
            $table->string('tax_code')->nullable();//ma so thue voi null
            $table->string('opening_hours')->nullable();//gio mo cua voi null
            $table->text('vision')->nullable();//tầm nhìn(thong tin ban quyen voi null)
            $table->text('mission')->nullable();//su menh voi null
            $table->integer('employee_count')->nullable();//so luong nhan vien voi null
            $table->string('facebook_url')->nullable();//link facebook voi null
            $table->string('instagram_url')->nullable();//link instagram voi null
            $table->string('twitter_url')->nullable();//link twitter voi null
            $table->string('youtube_url')->nullable();//link youtube voi null
            $table->string('zalo_phone')->nullable();//link zalo voi null
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_infos');
    }
};
