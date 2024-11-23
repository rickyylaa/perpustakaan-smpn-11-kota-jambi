<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Siswa;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $kelasIds = Kelas::pluck('id')->toArray();

        for ($i = 1; $i <= 50; $i++) {
            $tanggalLahir = $faker->dateTimeBetween('-18 years', '-15 years')->format('Y-m-d');

            Siswa::create([
                'barcode' => $faker->unique()->numberBetween(100000000, 999999999),
                'nisn' => $faker->unique()->numberBetween(1000000000, 9999999999),
                'nama' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['laki-laki', 'perempuan']),
                'tanggal_lahir' => $tanggalLahir,
                'foto' => 'avatar.png',
                'kelas_id' => $faker->randomElement($kelasIds),
                'status' => 'aktif'
            ]);
        }
    }
}
