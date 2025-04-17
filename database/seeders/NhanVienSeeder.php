<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NhanVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataNhanVien = [];

        for ($i = 1; $i <= 5; $i++) {
            $dataNhanVien[]=
        [
            'ma_nhan_vien' => 's001' . $i,
            'ten_nhan_vien' => 'Linh' . $i,
            'sdt' => '0123456789' . $i,
            'email' => 'linh@example.com' . $i,
            'mat_khau' => bcrypt('password'),
            'nam_sinh' => Carbon::create('1990', '01', '01')->addYears($i),
            'anh_dai_dien' => '' . $i,
            'ngay_lam' => '2022-01-03',
            'chuc_vu_id' => 1, // Giả sử là 1
            'phong_ban_id' => 1, // Giả sử là 1
            'id_bang_luong' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];

    }
    DB::table('nhan_viens')->insert($dataNhanVien);
}
}
