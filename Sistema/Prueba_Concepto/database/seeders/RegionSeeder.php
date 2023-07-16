<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        $regions = [
            [1, 'Arica y Parinacota'],
            [2, 'Tarapacá'],
            [3, 'Antofagasta'],
            [4, 'Atacama'],
            [5, 'Coquimbo'],
            [6, 'Valparaiso'],
            [7, 'Metropolitana de Santiago'],
            [8, 'Libertador General Bernardo O\'Higgins'],
            [9, 'Maule'],
            [10, 'Ñuble'],
            [11, 'Biobío'],
            [12, 'La Araucanía'],
            [13, 'Los Ríos'],
            [14, 'Los Lagos'],
            [15, 'Aisén del General Carlos Ibáñez del Campo'],
            [16, 'Magallanes y de la Antártica Chilena']
        ];

        $regions = array_map(function ($region) use ($now) {
            return [
                'id' => $region[0],
                'nombre' => $region[1],
                'updated_at' => $now,
                'created_at' => $now,
            ];
        }, $regions);

        DB::table('region')->insert($regions);
    }
}
