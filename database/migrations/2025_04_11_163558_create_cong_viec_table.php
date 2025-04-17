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
        Schema::create('cong_viec', function (Blueprint $table) {
            $table->id();
            $table->string('ten_cong_viec');
            $table->decimal('muc_luong',15,2);
            $table->text('mo_ta');
            $table->string('ca_lam');
            $table->unsignedBigInteger('id_chuc_vu');
            $table->unsignedBigInteger('id_phong_ban');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cong_viec');
    }
};
