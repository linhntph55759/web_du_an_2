<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class chucVuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chucVuData = [];

        for ($i = 1; $i <= 5; $i++) {
            $chucVuData[] = [
                'ten_chuc_vu' => 'Chức vụ ' . $i,
                'mo_ta' => 'Mô tả chức vụ ' . $i,
            ];
        }


        DB::table('chuvu')->insert($chucVuData);
}
}
