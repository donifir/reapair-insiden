<?php

namespace Database\Seeders;

use App\Models\InsidenTerjadiPadaPasien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InsidenTerjadiPadaPasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        InsidenTerjadiPadaPasien::create([
            'keterangan' => 'Penyakit Dalam dan Subspesialisasinya',
        ]);
        InsidenTerjadiPadaPasien::create([
            'keterangan' => 'Anak dan Subspesialisasinya',
        ]);
        InsidenTerjadiPadaPasien::create([
            'keterangan' => 'Bedah dan Subspesialisasinya',
        ]);
        InsidenTerjadiPadaPasien::create([
            'keterangan' => 'Obstetri dan Subspesialisasinya',
        ]);
        InsidenTerjadiPadaPasien::create([
            'keterangan' => 'THT dan Subspesialisasinya',
        ]);
        InsidenTerjadiPadaPasien::create([
            'keterangan' => 'Mata dan Subspesialisasinya',
        ]);
        InsidenTerjadiPadaPasien::create([
            'keterangan' => 'Saraf dan Subspesialisasinya',
        ]);
        InsidenTerjadiPadaPasien::create([
            'keterangan' => 'Anestesi dan Subspesialisasinya',
        ]);
        InsidenTerjadiPadaPasien::create([
            'keterangan' => 'Kulit dan Subspesialisasinya',
        ]);
        InsidenTerjadiPadaPasien::create([
            'keterangan' => 'Jantung dan Subspesialisasinya',
        ]);
        InsidenTerjadiPadaPasien::create([
            'keterangan' => 'Paru dan Subspesialisasinya',
        ]);
        InsidenTerjadiPadaPasien::create([
            'keterangan' => 'Jiwa dan Subspesialisasinya',
        ]);
        InsidenTerjadiPadaPasien::create([
            'keterangan' => 'Lain-lain',
            'keterangan_lanjutan'=>1,
        ]);
    }
}
