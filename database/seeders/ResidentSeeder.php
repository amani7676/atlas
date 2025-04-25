<?php

namespace Database\Seeders;

use App\Models\InfoResident;
use App\Models\Otagh;
use App\Models\Resident;
use App\Models\Takht;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();

        try {
            $takhts = Takht::pluck('id')->toArray();
            $otaghs = Otagh::pluck('id')->toArray();

            for ($i = 1; $i <= 10; $i++) {
                $resident = Resident::create([
                    'full_name' => fake()->name(),
                    'phone' => fake()->numerify('09#########'),
                    'takht_id' => fake()->optional()->randomElement($takhts),
                    'otagh_id' => fake()->optional()->randomElement($otaghs),
                    'start_date' => now()->subDays(rand(1, 30)),
                    'end_date' => now()->addDays(rand(30, 90)),
                ]);

                InfoResident::create([
                    'description' => fake()->sentence(),
                    'vadeh' => fake()->boolean(),
                    'ejareh' => fake()->boolean(),
                    'madrak' => fake()->boolean(),
                    'has_phone' => fake()->boolean(),
                    'bedehy' => fake()->boolean(),
                    'form' => fake()->boolean(),
                    'hamahang' => now()->addDays(rand(1, 15)),
                    'state' => fake()->randomElement(['active', 'reserve', 'leaving', 'exit']),
                    'job' => fake()->jobTitle(),
                    'age' => rand(20, 70),
                    'takhir' => rand(0, 10),
                    'resident_id' => $resident->id,
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
