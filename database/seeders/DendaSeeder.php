<?php

namespace Database\Seeders;

use App\Models\Denda;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Denda::create([
            'denda_pinjam' => '3000',
            'denda_hilang' => '50000'
        ]);
    }
}
