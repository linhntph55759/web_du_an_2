<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CongViecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $dataCongViec = [];

        for ($i = 1; $i <= 5; $i++) {
            $dataCongViec[]=
        [

            'ten_cong_viec' => 'makrting' . $i,
            'muc_luong' => '10000000' . $i,
            'mo_ta' => 'seo các thứ' . $i,
            'ca_lam' => 'cả ngày'. $i,
            'id_chuc_vu' => 1, // Giả sử là 1
            'id_phong_ban' => 1, // Giả sử là 1
            'created_at' => now(),
            'updated_at' => now(),
        ];

    }
    DB::table('cong_viec')->insert($dataCongViec);
    }
}
