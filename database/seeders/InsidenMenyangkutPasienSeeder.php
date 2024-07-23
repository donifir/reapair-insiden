<?php

namespace Database\Seeders;

use App\Models\InsidenMenyangkutPasien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InsidenMenyangkutPasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        InsidenMenyangkutPasien::create([
            'keterangan' => 'Pasien Rawat Inap',
        ]);
        InsidenMenyangkutPasien::create([
            'keterangan' => 'Pasien Rawat Jalan',
        ]);
        InsidenMenyangkutPasien::create([
            'keterangan' => 'Pasien IGD',
        ]);
        InsidenMenyangkutPasien::create([
            'keterangan' => 'Lain-lain',
            'keterangan_lanjutan'=>1,
        ]);
    }
}
