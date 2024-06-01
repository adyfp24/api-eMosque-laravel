<?php

namespace Database\Seeders;

use App\Models\JenisQurban;
use Illuminate\Database\Seeder;

class JenisQurbanSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenisQurbans = [
            ['nama_jenis' => 'Sapi'],
            ['nama_jenis' => 'Kambing'],
        ];

        foreach ($jenisQurbans as $jenisQurban) {
            JenisQurban::create($jenisQurban);
        }
    }
}
