<?php

namespace Database\Seeders;

use App\Models\role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['nama_role' => 'jamaah'],
            ['nama_role' => 'bendahara'],
            ['nama_role' => 'sekretaris'],
            ['nama_role' => 'ketua'],
        ];

        foreach($roles as $role){
            role::create($role);
        }
    }

}
