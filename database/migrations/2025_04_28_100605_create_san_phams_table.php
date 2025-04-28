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
        Schema::create('san_phams', function (Blueprint $table) {
            $table->id();
            $table->string('ma_san_pham')->unique();
            $table->string('ten_san_pham');
            $table->string('anh_san_pham')->nullable();
            $table->text('mo_ta')->nullable();
            $table->integer('so_luong')->default(0);
            $table->decimal('gia',15,2)->default(0);
            $table->decimal('gia_khuyen_mai',15,2)->nullable();
            $table->tinyInteger('trang_thai')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_phams');
    }
};
