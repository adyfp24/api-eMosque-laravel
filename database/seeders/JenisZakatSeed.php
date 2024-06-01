<?php

namespace Database\Seeders;

use App\Models\JenisZakat;
use Illuminate\Database\Seeder;

class JenisZakatSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenisZakats = [
            ['nama_jenis_zakat' => 'Beras'],
            ['nama_jenis_zakat' => 'Uang Tunai'],
        ];

        foreach ($jenisZakats as $jenisZakat) {
            JenisZakat::create($jenisZakat);
        }
    }
}
