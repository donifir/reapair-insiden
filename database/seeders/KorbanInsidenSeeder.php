<?php

namespace Database\Seeders;

use App\Models\KorbanInsiden;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KorbanInsidenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        KorbanInsiden::create([
            'keterangan' => 'Pasien',
        ]);
        KorbanInsiden::create([
            'keterangan' => 'Lain-lain',
            'keterangan_lanjutan'=>1,
        ]);
    }
}
