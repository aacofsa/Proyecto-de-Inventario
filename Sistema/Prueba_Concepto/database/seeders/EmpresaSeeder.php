<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $empresas = [
            [1,'76.111.111-1', 'Sicom SA', '+56912345678', 'dir 1','correo1@gmail','10.111.111-1', 'John','Doe','fulanito','+56912345679','johnDoe@gmail.com'],
            [2,'77.111.111-1', 'Hercot', '+56922345678', 'dir 2','correo2@gmail','12.111.111-1','Juanito', 'Perez','Diaz','+56922345679', 'jperez@gmail.com'],
        ];

        $now = now();
        $empresas = array_map( function ($empresa) use($now) {
            return [
                'rut' => $empresa[1],
                'nombre' => $empresa[2],
                'telefono' => $empresa[3],
                'direccion' => $empresa[4],
                'correo' => $empresa[5],
                'rl_rut' => $empresa[6],
                'rl_nombre' => $empresa[7],
                'rl_paterno' => $empresa[8],
                'rl_materno' => $empresa[9],
                'rl_telefono' => $empresa[10],
                'rl_correo' => $empresa[11],
                'updated_at' => $now,
                'created_at' => $now,
            ];
        }, $empresas);
        DB::table('empresa')->insert($empresas);
    }
}
