<?php

namespace Database\Seeders;

use App\Models\PenanggungJawab;
use Illuminate\Database\Seeder;

class PjSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $penanggungJawabs = [
            ['nama_pj' => 'pj-satu'],
            ['nama_pj' => 'pj-dua'],
            ['nama_pj' => 'pj-tiga'],
        ];

        foreach($penanggungJawabs as $pj){
            PenanggungJawab::create($pj);
        }
    }
}
