<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PemilikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'pemilik@example.com'],
            [
                'name' => 'Bapak Pemilik',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'pemilik',
                'phone' => '081234567890',
                'status' => 'aktif',
            ]
        );
    }
}
