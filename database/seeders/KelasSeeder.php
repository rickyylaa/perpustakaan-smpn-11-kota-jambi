<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelas::create(['nama_kelas' => 'Kelas 7 A']);
        Kelas::create(['nama_kelas' => 'Kelas 7 B']);
        Kelas::create(['nama_kelas' => 'Kelas 7 C']);
        Kelas::create(['nama_kelas' => 'Kelas 7 D']);
        Kelas::create(['nama_kelas' => 'Kelas 7 E']);

        Kelas::create(['nama_kelas' => 'Kelas 8 A']);
        Kelas::create(['nama_kelas' => 'Kelas 8 B']);
        Kelas::create(['nama_kelas' => 'Kelas 8 C']);
        Kelas::create(['nama_kelas' => 'Kelas 8 D']);
        Kelas::create(['nama_kelas' => 'Kelas 8 E']);

        Kelas::create(['nama_kelas' => 'Kelas 9 A']);
        Kelas::create(['nama_kelas' => 'Kelas 9 B']);
        Kelas::create(['nama_kelas' => 'Kelas 9 C']);
        Kelas::create(['nama_kelas' => 'Kelas 9 D']);
        Kelas::create(['nama_kelas' => 'Kelas 9 E']);
    }
}
