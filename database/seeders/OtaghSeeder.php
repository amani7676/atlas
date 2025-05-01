<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OtaghSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            ['id' => 1, 'name' => '101', 'total' => 4, 'vahed_id' => 1],
            ['id' => 2, 'name' => '102', 'total' => 8, 'vahed_id' => 1],
            ['id' => 3, 'name' => '103', 'total' => 6, 'vahed_id' => 1],
            ['id' => 4, 'name' => '104', 'total' => 4, 'vahed_id' => 1],
            ['id' => 5, 'name' => '105', 'total' => 4, 'vahed_id' => 1],
            ['id' => 6, 'name' => '106', 'total' => 4, 'vahed_id' => 1],
            ['id' => 7, 'name' => '107', 'total' => 2, 'vahed_id' => 1],
            ['id' => 8, 'name' => '108', 'total' => 2, 'vahed_id' => 1],
            ['id' => 9, 'name' => '109', 'total' => 6, 'vahed_id' => 1],
            ['id' => 10, 'name' => '110', 'total' => 4, 'vahed_id' => 1],

            ['id' => 11, 'name' => '201', 'total' => 6, 'vahed_id' => 2],
            ['id' => 12, 'name' => '202', 'total' => 6, 'vahed_id' => 2],
            ['id' => 13, 'name' => '203', 'total' => 6, 'vahed_id' => 2],
            ['id' => 14, 'name' => '204', 'total' => 4, 'vahed_id' => 2],
            ['id' => 15, 'name' => '205', 'total' => 4, 'vahed_id' => 2],
            ['id' => 16, 'name' => '206', 'total' => 6, 'vahed_id' => 2],
            ['id' => 17, 'name' => '207', 'total' => 4, 'vahed_id' => 2],
            ['id' => 18, 'name' => '208', 'total' => 4, 'vahed_id' => 2],
            ['id' => 19, 'name' => '209', 'total' => 4, 'vahed_id' => 2],
            ['id' => 20, 'name' => '210', 'total' => 2, 'vahed_id' => 2],

            ['id' => 21, 'name' => '301', 'total' => 6, 'vahed_id' => 3],
            ['id' => 22, 'name' => '302', 'total' => 6, 'vahed_id' => 3],
            ['id' => 23, 'name' => '303', 'total' => 6, 'vahed_id' => 3],
            ['id' => 24, 'name' => '304', 'total' => 4, 'vahed_id' => 3],
            ['id' => 25, 'name' => '305', 'total' => 4, 'vahed_id' => 3],
            ['id' => 26, 'name' => '306', 'total' => 6, 'vahed_id' => 3],
            ['id' => 27, 'name' => '307', 'total' => 4, 'vahed_id' => 3],
            ['id' => 28, 'name' => '308', 'total' => 4, 'vahed_id' => 3],
            ['id' => 29, 'name' => '309', 'total' => 6, 'vahed_id' => 3],
            ['id' => 30, 'name' => '310', 'total' => 6, 'vahed_id' => 3],
            ['id' => 31, 'name' => '311', 'total' => 2, 'vahed_id' => 3],
            ['id' => 32, 'name' => '312', 'total' => 6, 'vahed_id' => 3],

            ['id' => 33, 'name' => '401', 'total' => 6, 'vahed_id' => 4],
            ['id' => 34, 'name' => '402', 'total' => 6, 'vahed_id' => 4],
            ['id' => 35, 'name' => '403', 'total' => 6, 'vahed_id' => 4],
            ['id' => 36, 'name' => '404', 'total' => 4, 'vahed_id' => 4],
            ['id' => 37, 'name' => '405', 'total' => 4, 'vahed_id' => 4],
            ['id' => 38, 'name' => '406', 'total' => 6, 'vahed_id' => 4],
            ['id' => 39, 'name' => '407', 'total' => 4, 'vahed_id' => 4],
            ['id' => 40, 'name' => '408', 'total' => 4, 'vahed_id' => 4],
            ['id' => 41, 'name' => '409', 'total' => 4, 'vahed_id' => 4],
            ['id' => 42, 'name' => '410', 'total' => 2, 'vahed_id' => 4],
            ['id' => 43, 'name' => '411', 'total' => 6, 'vahed_id' => 4]

           
        ];

        DB::table('otaghs')->insert($rooms);
    }
}
