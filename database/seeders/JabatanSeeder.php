<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Jabatan::create([
            'nama_jabatan' => 'pelaksana IT',
            'keterangan_jabatan' => 'pelaksana',
            'level' => '5',
        ]);
        Jabatan::create([
            'nama_jabatan' => 'PJO IT',
            'keterangan_jabatan' => 'Penanggung Jawab',
            'level' => '4',
        ]);
        Jabatan::create([
            'nama_jabatan' => 'KARU IT',
            'keterangan_jabatan' => 'Kepala Ruangan',
            'level' => '3',
        ]);
        Jabatan::create([
            'nama_jabatan' => 'Kabit IT',
            'keterangan_jabatan' => 'Kepala Bidang HAR',
            'level' => '2',
        ]);


        Jabatan::create([
            'nama_jabatan' => 'pelaksana HAR',
            'keterangan_jabatan' => 'pelaksana',
            'level' => '5',
        ]);
        Jabatan::create([
            'nama_jabatan' => 'PJO HAR',
            'keterangan_jabatan' => 'Penanggung Jawab HAR',
            'level' => '4',
        ]);
        Jabatan::create([
            'nama_jabatan' => 'KARU HAR' ,
            'keterangan_jabatan' => 'Kepala Ruangan HAR',
            'level' => '3',
        ]);
        Jabatan::create([
            'nama_jabatan' => 'Kabit HAR',
            'keterangan_jabatan' => 'Kepala Bidang HAR',
            'level' => '2',
        ]);

        // level1
        Jabatan::create([
            'nama_jabatan' => 'Kom_mutu',
            'keterangan_jabatan' => 'Komite Mutu',
            'level' => '1',
        ]);
        Jabatan::create([
            'nama_jabatan' => 'Karumkit',
            'keterangan_jabatan' => 'Kepala Rumah Sakit',
            'level' => '1',
        ]);
    }
}
