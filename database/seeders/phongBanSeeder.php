<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class phongBanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataPhongBan =[];
        for($i = 1; $i <= 5; $i++){
            $dataPhongBan[]=[
            'ten_phong_ban' => 'Phòng Hành chính' .$i,
            'mo_ta' => 'Phòng hành chính 1' .$i,
            ];

        }
        DB::table('phong_ban')->insert($dataPhongBan);
    }
}
