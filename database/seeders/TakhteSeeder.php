<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TakhteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $otaghs = DB::table('otaghs')->get();

        $takhts = [];
        $tacheId = 1;

        foreach ($otaghs as $otagh) {
            // برای هر اتاق تخت‌ها رو میسازیم
            for ($i = 1; $i <= $otagh->total; $i++) {
                $takhts[] = [
                    'id' => $tacheId++,
                    'name' => $otagh->name . '_' . $i,
                    'otagh_id' => $otagh->id,
                    'state' => 'empty',
                ];
            }
        }

        // درج تخت‌ها در دیتابیس
        DB::table('takhts')->insert($takhts);
    }
}
