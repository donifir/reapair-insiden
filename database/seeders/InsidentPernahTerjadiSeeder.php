<?php

namespace Database\Seeders;

use App\Models\InsidentPernahTerjadi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InsidentPernahTerjadiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        InsidentPernahTerjadi::create([
            'keterangan' => 'Ya, apabila ya isi bagian dibawah ini',
            'keterangan_lanjutan'=>1,
        ]);
        InsidentPernahTerjadi::create([
            'keterangan' => 'tidak',
        ]);
    }
}
