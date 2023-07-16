<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class EmpresaController extends Controller
{
    const EMAIL_VALIDATION = 'nullable|email';
    const COMMON_STRING_VALIDATION = 'string|nullable|between:2,16';
    const INDEX = 'empresa.index';

    function vista_index(){
        $empresas = Empresa::orderBy('id', 'ASC')->get();
        return view(self::INDEX)->with('empresas', $empresas);
    }

    public function vista_crear()
    {
        return view('empresa.crear')->with('empresa',null);
    }

    // guarda en la bdd la nueva empresa
    public function guardar(Request $request)
    {
        try{
            $request->validate([
                'rut' => 'nullable|between:9,12|unique:empresa,rut',
                'nombre' => 'required|between:2,32',
                'telefono' => 'required|between:9,16',
                'direccion' => 'required|max:128',
                'correo' => 'nullable|email',
                'activo' => 'nullable|boolean',
                'rl_rut' => 'required|between:9,12|unique:empresa,rl_rut',
                'rl_nombre' => 'required|between:2,16',
                'rl_paterno' => 'required|between:2,16',
                'rl_materno' =>  self::COMMON_STRING_VALIDATION,
                'rl_telefono' => 'required|between:9,16',
                'rl_correo' => 'required|email',
            ]);
        }catch(ValidationException $err){
            $errors = $err->errors();
            $errors = $this->validarAmbosRut($request->all()['rut'], $request->all()['rl_rut'], $errors);
            return Redirect::back()->withErrors($errors)->withInput();
        }
        $errors = [
            'rut' => [],
            'rl_rut' => []
        ];
        $errors = $this->validarAmbosRut($request->all()['rut'], $request->all()['rl_rut'], $errors);
        if(count($errors['rut']) > 0 || count($errors['rl_rut']) > 0 ){
            return Redirect::back()->withErrors($errors)->withInput();
        }
        Empresa::create($request->all());
        $empresas = Empresa::orderBy('id', 'ASC')->get();
        return view(self::INDEX)->with('empresas', $empresas);
    }

    public function vista_editar($id){
        $empresa = Empresa::where('id', $id)->first();
        if(!$empresa){
            return abort(404);
        }
        return view('empresa.editar')->with('empresa',$empresa);
    }

    public function actualizar($id, Request $request)
    {

        try{
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
        }catch(ValidationException $err){
            $errors = $err->errors();
            $errors = $this->validarAmbosRut($request->all()['rut'], $request->all()['rl_rut'], $errors);
            return Redirect::back()->withErrors($errors)->withInput();
        }
        $errors = [
            'rut' => [],
            'rl_rut' => []
        ];
        $errors = $this->validarAmbosRut($request->all()['rut'], $request->all()['rl_rut'], $errors);
        if(count($errors['rut']) > 0 || count($errors['rl_rut']) > 0 ){
            return Redirect::back()->withErrors($errors)->withInput();
        }

        $empresa = Empresa::find($id);
        // otra entrega, verificar si el rut ingresado es igual al actual
        // si son iguales, remover del request all
        if (!$empresa) {
            return abort(404);
        }
        $data = array_filter($request->except('_token'));
        $empresa->update($data);

        $empresas = Empresa::orderBy('id', 'ASC')->get();
        return view(self::INDEX)->with('empresas', $empresas);
    }

    public function vista_ver($id)
    {
        $empresa = Empresa::find($id);
        $bodegas = $empresa->bodegas;
        if(!$empresa){
            return abort(404);
        }
        return view('empresa.ver')->with([
            'empresa' => $empresa,
            'bodegas' => $bodegas
        ]);
    }

    public function metricas($id){
        $empresa = Empresa::find($id);
        if(!$empresa){
            return abort(404);
        }
        
        $compras = DB::table('registro_producto')
            ->select(['precio_total', 'fecha'])
            ->join('lote', 'registro_producto.id', '=', 'lote.id_registro')
            ->join('producto', 'lote.id_producto', '=', 'producto.id')
            ->join('producto_bodegas','producto.id', '=', 'producto_bodegas.id_producto' )
            ->join('bodega','producto_bodegas.id_bodega', '=', 'bodega.id' )
            ->where('bodega.id_empresa','=',$id)
            ->where('tipo','=','compra')
            ->distinct()
            ->get();

        $ventas = DB::table('registro_producto')
            ->select(['precio_total', 'fecha'])
            ->join('lote', 'registro_producto.id', '=', 'lote.id_registro')
            ->join('producto', 'lote.id_producto', '=', 'producto.id')
            ->join('producto_bodegas','producto.id', '=', 'producto_bodegas.id_producto' )
            ->join('bodega','producto_bodegas.id_bodega', '=', 'bodega.id' )
            ->where('bodega.id_empresa','=',$id)
            ->where('tipo','=','venta')
            ->distinct()
            ->get();

        $data = (object) [
            'total_compras' => 0,
            'total_ventas' => 0,
            'total_ganancias' => 0,
            'total_impuestos' => 0,
            'compras' => [0,0,0,0,0,0,0,0,0,0,0,0],
            'ventas' => [0,0,0,0,0,0,0,0,0,0,0,0]
        ];
        
        foreach($compras as $compra){
            $mes =  date('n', strtotime($compra->fecha) )-1;
            $data->total_compras += intval($compra->precio_total);
            $data->compras[$mes] += intval($compra->precio_total);
            $data->total_ganancias -= intval($compra->precio_total);
        }
        foreach($ventas as $venta){
            $mes =  date('n', strtotime($venta->fecha) )-1;
            $data->total_ventas += intval($venta->precio_total);
            $data->ventas[$mes] += intval($venta->precio_total);
            $data->total_ganancias += intval($venta->precio_total);
        }
        $data->total_impuestos = $data->total_ventas*0.1596 - $data->total_compras*0.19;

        $compras = "";
        $ventas = "";

        for($i = 0; $i < 12; $i++){
            $compras =  $compras ." ". $data->compras[$i];
            $ventas =  $ventas ." ". $data->ventas[$i];
        }
        $data->compras = $compras;
        $data->ventas = $ventas;
        return view('empresa.metricas')->with('metricas', $data);
    }

    private function validarAmbosRut($rut_empresa, $rut_representante, $errors){

        if($rut_empresa){
            $empresa_valido = $this->validarRut($rut_empresa);
            if(!$empresa_valido){
                if( count( array_keys($errors,'rut') ) == 0) {
                    $errors['rut'] = [];
                }
                array_push($errors['rut'], "Rut Invalido");
            }
        }

        if($rut_representante){
            $representante_valido = $this->validarRut($rut_representante);
            if(!$representante_valido){
                if( count( array_keys($errors,'rl_rut') ) == 0) {
                    $errors['rl_rut'] = [];
                }
                array_push($errors['rl_rut'], "Rut Invalido");
            }
        }

        return $errors;
    }

    private function validarRut($rut){
        $rut = str_replace(".","", $rut);
        $split_aux = explode("-", $rut);
        if(count($split_aux) != 2 ){
            return false;
        }
        $digito_verificador = $split_aux[1];
        $numero = intval($split_aux[0]);

        $contador = 0;
        $i = 0;
        while($numero != 0){
            $digito = $numero%10;
            $contador += $digito * ($i%6 + 2);
            $i++;
            $numero = intval(($numero/10));
        }
        $resultado_digito = 11 - $contador%11;

        if($resultado_digito==11){
            return "0" == $digito_verificador;
        }else if($resultado_digito==10){
            return "k" == strtolower($digito_verificador);
        } else {
            return $resultado_digito == $digito_verificador;
        } 
    }
}
