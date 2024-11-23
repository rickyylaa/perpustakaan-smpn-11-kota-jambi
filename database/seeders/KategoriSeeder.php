<?php

namespace Database\Seeders;

use App\Models\KategoriDanRak;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriDanRak::create([
            'nama' => 'Bahasa',
            'rak' => 1,
            'baris' => 1
        ]);

        KategoriDanRak::create([
            'nama' => 'Bahasa',
            'rak' => 1,
            'baris' => 2
        ]);

        KategoriDanRak::create([
            'nama' => 'Bahasa',
            'rak' => 1,
            'baris' => 3
        ]);

        KategoriDanRak::create([
            'nama' => 'Sejarah',
            'rak' => 1,
            'baris' => 1
        ]);

        KategoriDanRak::create([
            'nama' => 'Sejarah',
            'rak' => 1,
            'baris' => 2
        ]);

        KategoriDanRak::create([
            'nama' => 'Sejarah',
            'rak' => 1,
            'baris' => 3
        ]);

        KategoriDanRak::create([
            'nama' => 'Komik',
            'rak' => 1,
            'baris' => 1
        ]);

        KategoriDanRak::create([
            'nama' => 'Komik',
            'rak' => 1,
            'baris' => 2
        ]);

        KategoriDanRak::create([
            'nama' => 'Komik',
            'rak' => 1,
            'baris' => 3
        ]);

        KategoriDanRak::create([
            'nama' => 'Agama',
            'rak' => 1,
            'baris' => 1
        ]);

        KategoriDanRak::create([
            'nama' => 'Agama',
            'rak' => 1,
            'baris' => 2
        ]);

        KategoriDanRak::create([
            'nama' => 'Agama',
            'rak' => 1,
            'baris' => 3
        ]);

        KategoriDanRak::create([
            'nama' => 'Romansa',
            'rak' => 1,
            'baris' => 1
        ]);

        KategoriDanRak::create([
            'nama' => 'Romansa',
            'rak' => 1,
            'baris' => 2
        ]);

        KategoriDanRak::create([
            'nama' => 'Romansa',
            'rak' => 1,
            'baris' => 3
        ]);
    }
}
