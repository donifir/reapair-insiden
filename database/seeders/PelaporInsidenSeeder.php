<?php

namespace Database\Seeders;

use App\Models\PelaporInsiden;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelaporInsidenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PelaporInsiden::create([
            'keterangan' => 'Karyawan : Dokter / Perawat / Petugas Lainya',
        ]);
        PelaporInsiden::create([
            'keterangan' => 'Pasien',
        ]);
        PelaporInsiden::create([
            'keterangan' => 'Keluarga / Pedamping pasien',
        ]);
        PelaporInsiden::create([
            'keterangan' => 'Pengunjung',
        ]);
        PelaporInsiden::create([
            'keterangan' => 'Lain-lain',
            'keterangan_lanjutan'=>1,
        ]);
    }
}
