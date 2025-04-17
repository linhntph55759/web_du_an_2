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
        Schema::create('bang_luong', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nhan_vien_id')->unique();
            $table->decimal('tien_thuong', 15, 2)->nullable();
            $table->unsignedBigInteger('id_trang_thai')->default(2);
            $table->timestamps();
            $table->foreign('nhan_vien_id')->references('id')->on('nhan_viens')->onDelete('cascade');
            $table->foreign('id_trang_thai')->references('id')->on('trang_thai')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bang_luong');
    }
};
