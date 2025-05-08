<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VahedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vaheds = [
            [
                'id' => 1,
                'name' => 'vahed1',
                'hoveat' => 'طبقه اول',
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 2,
                'name' => 'vahed2',
                'hoverat' => 'طبقه دوم',
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 3,
                'name' => 'vahed3',
                'hoverat' => 'طبقه سوم',
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 4,
                'name' => 'vahed4',
                'hoveat' => 'طبقه جهارم',
                'created_at' => null,
                'updated_at' => null
            ]
        ];

        DB::table('vaheds')->insert($vaheds);
    }
}
