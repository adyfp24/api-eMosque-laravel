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
            ['nama_pj' => 'pak syaiful'],
            ['nama_pj' => 'pak bahri'],
            ['nama_pj' => 'pak ujang'],
        ];

        foreach($penanggungJawabs as $pj){
            PenanggungJawab::create($pj);
        }
    }
}
