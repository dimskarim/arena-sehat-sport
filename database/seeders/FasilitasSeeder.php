<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fasilitas;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fasilitas = [
            ['name' => 'AC Ruangan', 'icon' => 'ac_unit'],
            ['name' => 'Ruang Loker', 'icon' => 'lock'],
            ['name' => 'Area Parkir', 'icon' => 'local_parking'],
            ['name' => 'Kamar Mandi', 'icon' => 'shower'],
            ['name' => 'Pencahayaan LED', 'icon' => 'light_mode'],
            ['name' => 'Papan Skor', 'icon' => 'scoreboard'],
            ['name' => 'Wi-Fi Gratis', 'icon' => 'wifi'],
            ['name' => 'Kafetaria', 'icon' => 'local_cafe'],
        ];

        foreach ($fasilitas as $f) {
            Fasilitas::firstOrCreate(['name' => $f['name']], $f);
        }
    }
}
