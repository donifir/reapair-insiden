<?php

namespace Database\Seeders;

use App\Models\JenisInsiden;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisLayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        JenisInsiden::create([
            'keterangan' => 'Kejadian Nyaris Cidera / KNC (Near miss)',
        ]);
        JenisInsiden::create([
            'keterangan' => 'Kejadian Tidak diharapkan / KTD (Adverse Event) / Kejadian Sentinel (Sentinel Event)',
        ]);
        JenisInsiden::create([
            'keterangan' => 'Kejadian Tidak Cidera / KTC',
        ]);
        JenisInsiden::create([
            'keterangan' => 'KPC',
        ]);
    }
}
