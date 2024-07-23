<?php

namespace Database\Seeders;

use App\Models\TindakanDilakukanOleh;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TindakanDilakukanOlehSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TindakanDilakukanOleh::create([
            'keterangan' => 'Tim',
        ]);
        TindakanDilakukanOleh::create([
            'keterangan' => 'Dokter',
        ]);
        TindakanDilakukanOleh::create([
            'keterangan' => 'Perawat',
        ]);
        TindakanDilakukanOleh::create([
            'keterangan' => 'Petugas Lainya',
            'keterangan_lanjutan'=>1,
        ]);
    }
}
