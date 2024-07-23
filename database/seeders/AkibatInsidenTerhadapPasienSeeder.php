<?php

namespace Database\Seeders;

use App\Models\AkibatInsidenTerhadapPasien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AkibatInsidenTerhadapPasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        AkibatInsidenTerhadapPasien::create([
            'keterangan' => 'Kematian',
        ]);
        AkibatInsidenTerhadapPasien::create([
            'keterangan' => 'Cedera Irreversibel / Cedera Berat',
        ]);
        AkibatInsidenTerhadapPasien::create([
            'keterangan' =>'Cedera Reversibel / Cedera Sedang',
        ]);
        AkibatInsidenTerhadapPasien::create([
            'keterangan' =>'Cedera Ringan',
        ]);
        AkibatInsidenTerhadapPasien::create([
            'keterangan' =>'Tidak ada cedera',
        ]);
    }
}
