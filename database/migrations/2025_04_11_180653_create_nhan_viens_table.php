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
        Schema::create('nhan_viens', function (Blueprint $table) {
            $table->id();
            $table->string('ma_nhan_vien')->unique();
            $table->string('ten_nhan_vien');
            $table->string('sdt');
            $table->string('email')->unique();
            $table->string('mat_khau');
            $table->date('nam_sinh');
            $table->string('anh_dai_dien')->nullable();
            $table->date('ngay_lam');
            $table->unsignedBigInteger('chuc_vu_id');
            $table->unsignedBigInteger('phong_ban_id');
            $table->unsignedBigInteger('id_bang_luong')->nullable();
                $table->timestamps();
                $table->foreign('chuc_vu_id')->references('id')->on('chuvu')->onDelete('cascade');
            $table->foreign('phong_ban_id')->references('id')->on('phong_ban')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhan_viens');
    }
};
