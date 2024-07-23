<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(InsidenMenyangkutPasienSeeder::class);
        $this->call(InsidenTerjadiPadaPasienSeeder::class);
        $this->call(JenisLayananSeeder::class);
        $this->call(KorbanInsidenSeeder::class);
        $this->call(PelaporInsidenSeeder::class);
        $this->call(TindakanDilakukanOlehSeeder::class);
        $this->call(InsidentPernahTerjadiSeeder::class);
        $this->call(JabatanSeeder::class);
        $this->call(AkibatInsidenTerhadapPasienSeeder::class);
        $this->call(UnitSeeder::class);
        User::create([
            'name' => 'doni',
            'email' => 'doni@gmail.com',
            'password' => '$2y$12$DrD5gOSgDpqd.xOd/8Ynt.KJub1C6CGL9dRSCoI4QFwmKZ4wLu2DC',
            'jabatan_id' => '1',
            'unit_id' => '1',
        ]);
        User::create([
            'name' => 'wawan',
            'email' => 'wawan@gmail.com',
            'password' => '$2y$12$DrD5gOSgDpqd.xOd/8Ynt.KJub1C6CGL9dRSCoI4QFwmKZ4wLu2DC',
            'jabatan_id' => '3',
            'unit_id' => '1',
        ]);
        User::create([
            'name' => 'p.diki',
            'email' => 'p.diki@gmail.com',
            'password' => '$2y$12$DrD5gOSgDpqd.xOd/8Ynt.KJub1C6CGL9dRSCoI4QFwmKZ4wLu2DC',
            'jabatan_id' => '4',
            'unit_id' => '1',
        ]);


        User::create([
            'name' => 'fian',
            'email' => 'dian@gmail.com',
            'password' => '$2y$12$DrD5gOSgDpqd.xOd/8Ynt.KJub1C6CGL9dRSCoI4QFwmKZ4wLu2DC',
            'jabatan_id' => '5',
            'unit_id' => '2',
        ]);
        User::create([
            'name' => 'm.arif',
            'email' => 'm.arif@gmail.com',
            'password' => '$2y$12$DrD5gOSgDpqd.xOd/8Ynt.KJub1C6CGL9dRSCoI4QFwmKZ4wLu2DC',
            'jabatan_id' => '7',
            'unit_id' => '2',
        ]);
        User::create([
            'name' => 'p.dedi',
            'email' => 'p.dedi@gmail.com',
            'password' => '$2y$12$DrD5gOSgDpqd.xOd/8Ynt.KJub1C6CGL9dRSCoI4QFwmKZ4wLu2DC',
            'jabatan_id' => '8',
            'unit_id' => '2',
        ]);
        

        User::create([
            'name' => 'm.winda',
            'email' => 'm.winda@gmail.com',
            'password' => '$2y$12$DrD5gOSgDpqd.xOd/8Ynt.KJub1C6CGL9dRSCoI4QFwmKZ4wLu2DC',
            'jabatan_id' => '9',
            'unit_id' => '3',
        ]);
        User::create([
            'name' => 'p.andre',
            'email' => 'p.andre@gmail.com',
            'password' => '$2y$12$DrD5gOSgDpqd.xOd/8Ynt.KJub1C6CGL9dRSCoI4QFwmKZ4wLu2DC',
            'jabatan_id' => '10',
            'unit_id' => '3',
        ]);
    }
}
