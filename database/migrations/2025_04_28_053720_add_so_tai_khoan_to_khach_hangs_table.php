<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('khach_hangs', function (Blueprint $table) {
            $table->string('so_tai_khoan')->nullable();
            $table->string('ten_ngan_hang')->change(); // Thêm cột 'so_tai_khoan'
        });
    }

    public function down()
    {
        Schema::table('khach_hangs', function (Blueprint $table) {
            $table->dropColumn('so_tai_khoan'); // Xóa cột 'so_tai_khoan' nếu rollback
            $table->integer('ten_ngan_hang')->change();
        });
    }

};
