<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kegiatan;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $kegiatans = [
            ['nama_kegiatan' => 'sholat jumat'],
            ['nama_kegiatan' => 'sholat ied'],
            ['nama_kegiatan' => 'istigosah'],
            ['nama_kegiatan' => 'hari besar'],
        ];

        foreach ($kegiatans as $kegiatan) {
            Kegiatan::create($kegiatan);
        }
    }
}

