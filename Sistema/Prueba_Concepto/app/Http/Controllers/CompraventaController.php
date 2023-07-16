<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro_producto;
use App\Models\Lote;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;


class CompraventaController extends Controller
{
    public function index()
    {
        // Toma los primeros 30 registros de compraventa
        $datos['rps']= Registro_producto::paginate(30);

        return view('compraventa.index',$datos);
    }

    public function create()
    {
        return view('compraventa.create');
    }

    public function store(Request $request)
    {
        // Elimina token del request
        $datosRP = $request->except('_token','redir');
        $redir = $request->redir;

        // Crea validador para registro_producto y valida los datos de registro_producto
        $validatorRP = Validator::make($datosRP,[
                'precio_total'=>'required|integer|min:0',
                'fecha'=>'required|date',
                'tipo'=>'required|in:compra,venta',
                'factura'=>'nullable|string',
        ]);

        // Si falla la validacion retorna con errores
        if($validatorRP->fails()){
            return redirect()->back()->withErrors($validatorRP)->withInput();
        }

        // Agrega nueva entreada a la tabla de Registro producto
        $id_reg = Registro_producto::insertGetId($datosRP);
        
        // Verifica si debe redireccionar a la creacion de lotes para el registro o al index
        if($redir == 'Continuar a lotes'){
            $modo = 'creacion';
            return redirect('compraventa/lotes/'.$id_reg)->with( ['modo' => $modo]);
        }

        return redirect('compraventa')->with('mensajeSuccess','Movimiento creado');

    }

    public function show($id)
    {
        $rp = Registro_Producto::findOrFail($id);
        return view('compraventa.show',compact('rp'));
    }

    public function edit($id)
    {
        $rp = Registro_Producto::findOrFail($id);
        return view('compraventa.edit',compact('rp'));
    }

    public function update(Request $request, $id)
    {

        // Elimina token del request
        $datosRP = $request->except('_token','_method','redir');

        // Crea validador para registro_producto y valida los datos de registro_producto
        $validatorRP = Validator::make($datosRP,[
                'precio_total'=>'required|integer|min:0',
                'fecha'=>'required|date',
                'tipo'=>'required|in:compra,venta',
                'factura'=>'nullable|string',
        ]);

        // Si falla la validacion retorna con errores
        if($validatorRP->fails()){
            return redirect()->back()->withErrors($validatorRP)->withInput();
        }

        // Actualiza el registro de producto
        Registro_producto::where('id','=',$id)->update($datosRP);
        
        $rp = Registro_producto::findOrFail($id);
        return redirect('compraventa')->with('mensajeSuccess','Movimiento editado');

    }

    public function destroy($id)
    {

        // Eliminar lotes
        $n = Lote::where('id_registro',$id)->delete();

        // Eliminar registro de producto
        Registro_producto::destroy($id);

        return redirect('compraventa')->with('mensajeSuccess','Movimiento eliminado');
    }

    public function compraventa_detalle($id)
    {
        // Retorna informacion de registro de producto
        return Registro_producto::findOrFail($id);
    }

    public function obtenerLotesRP($id)
    {
        // Retornar lotes cuyo id_registro sea el entregado como parametro de funcion
        return Lote::all()->where('id_registro','=',$id);
    }

    public function obtenerProductos($ids)
    {
        // Decodificar array
        $param = json_decode($_REQUEST['ids']);

        // Retornar productos cuyo id se encuentre en ids
        return Producto::whereIn('id', $param )->get();
    }

    // Manejo de lotes

    public function indexLotes($id){
        $registro = Registro_producto::findOrFail($id);
        $datos = Lote::where('id_registro',$id)->get();
        return view('compraventa.lotes.index',compact('datos','registro'));
    }
}