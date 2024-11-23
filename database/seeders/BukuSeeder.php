<?php

namespace Database\Seeders;

use App\Models\Buku;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use App\Models\KategoriDanRak;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $kategoriIds = KategoriDanRak::pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            $judul = $faker->sentence(3);

            Buku::create([
                'isbn' => $faker->isbn13,
                'judul' => $judul,
                'slug' => Str::slug($judul),
                'penulis' => $faker->name,
                'kategori_id' => $faker->randomElement($kategoriIds),
                'penerbit' => $faker->company,
                'tahun_terbit' => $faker->year,
                'stok_buku' => $faker->numberBetween(1, 50),
                'deskripsi' => $faker->paragraph(4),
                'sampul' => 'sampul.png',
                'status' => 'aktif',
            ]);
        }
    }
}
