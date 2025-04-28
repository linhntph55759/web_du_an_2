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
        Schema::create('khach_hangs', function (Blueprint $table) {
            $table->id();
            $table->string('ma_khach_hang')->unique();
            $table->string('ten_khach_hang');
            $table->string('sdt');
            $table->string('email')->unique();
            $table->string('mat_khau');
            $table->string('dia_chi');
            $table->string('anh')->nullable();
            $table->date('ngay_sinh');
            $table->tinyInteger('ten_ngan_hang')->default(1);
            $table->string('so_tai_kkhoan')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khach_hangs');
    }
};
