<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Unit::create([
            'nama_unit' => 'IT',
            'keterangan' => 'IT Loyo',
            'karu' => '2',
            'kabit' => '3',
        ]);
        Unit::create([
            'nama_unit' => 'HAR',
            'keterangan' => 'HAR',
            'karu' => '5',
            'kabit' => '6',
        ]);
    }
}
