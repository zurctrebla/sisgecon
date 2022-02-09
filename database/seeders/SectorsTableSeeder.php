<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Seeder;

class SectorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectors = [
            'Manutenção',
            'Segurança',
            'Elétrica',
            'Copa',
            'Financeiro',
            'Adm',
            'Almoxarifado',
            'Ti',
            'Rh',
        ];

        foreach ($sectors as $sector) {
            Sector::create(['name' => $sector]);
        }
    }
}
