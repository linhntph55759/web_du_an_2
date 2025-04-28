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
        Schema::create('don_hangs', function (Blueprint $table) {
            $table->id();
            $table->string('ma_don_hang')->unique();
            $table->foreignId('khach_hang_id')->constrained('khach_hangs');
            $table->foreignId('san_pham_id')->constrained('san_phams');
            $table->integer('so_luong')->default(1);
            $table->decimal('tien_ship',15,2)->nullable();
            $table->decimal('tong_tien', 15, 2)->nullable();
            $table->tinyInteger('trang_thais')->default(1);
            $table->text('ghi_chu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_hangs');
    }
};
