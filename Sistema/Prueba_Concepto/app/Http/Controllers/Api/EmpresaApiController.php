<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empresa;

class EmpresaApiController extends Controller
{
    const EMAIL_VALIDATION = 'nullable|email';
    const COMMON_STRING_VALIDATION = 'string|nullable|between:2,16';

    public function store(Request $request)
    {

        $request->validate([
            'rut' => 'nullable|between:9,12|unique:empresa,rut',
                'nombre' => 'required|between:2,32',
                'telefono' => 'required|between:9,16',
                'direccion' => 'required|max:128',
                'correo' => self::EMAIL_VALIDATION,
                'activo' => 'nullable|boolean',
                'rl_rut' => 'nullable|between:9,12|unique:empresa,rl_rut',
                'rl_nombre' => 'required|between:2,16',
                'rl_paterno' => 'required|between:2,16',
                'rl_materno' =>  self::COMMON_STRING_VALIDATION,
                'rl_telefono' => 'required|between:9,16',
                'rl_correo' => 'required|email',
        ]);
        Empresa::create($request->all());

        return redirect('/empresa');
    }

    public static function index(){
        return Empresa::all();
    }

    public function find($id)
    {
        return Empresa::find($id);
    }

    public function patch($id, Request $request)
    {
        $request->validate([
            'rut' =>  'string|nullable|between:9,12|unique:empresa,rut,'.$id,
            'nombre' => 'string|nullable|between:2,32',
            'telefono' => 'string|nullable|between:9,16',
            'direccion' => 'string|nullable|max:128',
            'correo' => self::EMAIL_VALIDATION,
            'activo' => 'nullable|boolean',
            'rl_rut' => 'string|nullable|between:9,12|unique:empresa,rl_rut,'.$id,
            'rl_nombre' => self::COMMON_STRING_VALIDATION,
            'rl_paterno' =>  self::COMMON_STRING_VALIDATION,
            'rl_materno' =>  self::COMMON_STRING_VALIDATION,
            'rl_telefono' => 'string|nullable|between:9,16',
            'rl_correo' => self::EMAIL_VALIDATION,
        ]);

        $empresa = Empresa::find($id);
        // otra entrega, verificar si el rut ingresado es igual al actual
        // si son iguales, remover del request all
        if (!$empresa) {
            return [
                'status' => 'error',
                'message' => 'Empresa no existe',
            ];
        }
        $empresa->update($request->all());

        return [
            'status' => 'ok',
            'message' => 'empresa actualizada con exito',
        ];
    }
}
