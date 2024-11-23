<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nip' => '1',
            'nama' => 'super admin',
            'password' => Hash::make('1'),
            'telepon' => '081234567890',
            'jenis_kelamin' => 'laki-laki',
            'alamat' => 'Jambi',
            'foto' => 'avatar.png',
            'status' => 'aktif'
        ])->assignRole('admin');

        User::create([
            'nip' => '200207112024241001',
            'nama' => 'super petugas',
            'password' => Hash::make('1'),
            'telepon' => '081234567890',
            'jenis_kelamin' => 'laki-laki',
            'alamat' => 'Jambi',
            'foto' => 'avatar.png',
            'status' => 'aktif'
        ])->assignRole('petugas');

        User::create([
            'nip' => '2',
            'nama' => 'petugas',
            'password' => Hash::make('1'),
            'telepon' => '081234567890',
            'jenis_kelamin' => 'laki-laki',
            'alamat' => 'Jambi',
            'foto' => 'avatar.png',
            'status' => 'aktif'
        ])->assignRole('petugas');
    }
}
