<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BodegaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $now = now();
        $bodegas = [
            [1, 'Bodega 1 test emp 1', 'test', 23,'dir 1', 1],
            [2, 'Bodega 2 test emp 1', 'test', 24,'dir 2', 1],
            [3, 'Bodega 1 test emp 2', 'test', 24,'dir 3', 2],
        ];
        $bodegas = array_map(function ($bodega) use ($now) {
            return [
                'nombre' => $bodega[1],
                'descripcion' => $bodega[2],
                'id_comuna' => $bodega[3],
                'direccion' => $bodega[4],
                'id_empresa' => $bodega[5],
                'updated_at' => $now,
                'created_at' => $now,
            ];
        }, $bodegas);
        DB::table('bodega')->insert($bodegas);
    }
}
