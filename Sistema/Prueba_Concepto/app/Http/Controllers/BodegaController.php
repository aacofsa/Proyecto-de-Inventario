<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\EmpresaApiController;
use App\Models\Bodega;
use App\Models\Comuna;
use App\Models\Empresa;
use Illuminate\Http\Request;

class BodegaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Toma las primeras 5 bodegas.
        $datos['bodegas'] = Bodega::paginate(100);
        $comunas = Comuna::all();
        $empresas = Api\EmpresaApiController::index();
        return view('bodega.index', $datos, compact('empresas', 'comunas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $comunas = Comuna::all();
        $empresas = Api\EmpresaApiController::index();


        return view('bodega.create', compact('empresas', 'comunas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $camposBodega = [

            'id_comuna' => 'required|int|',
            'id_empresa' => 'required|int|',
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|max:100',
            'direccion' => 'required|string|max:50',
            'hora_funcionamiento' => 'required|string|max:30',

        ];

        $mensaje = [
            'required'=>'El :attribute es requerido',
            'nombre.required' => 'El nombre de la bodega es requerido',
            'descripcion.required' => 'El campo descripción es requerido',
            'direccion.required' => 'El campo dirección es requerido',
            'hora_funcionamiento.required' => 'La hora de funcionamiento es requerida',

        ];

        $this->validate($request, $camposBodega, $mensaje); // Se validan los campos y se mostraran los mensajes

        $comunas = Comuna::all();
        $empresas = Api\EmpresaApiController::index();

        // Recibe todos los datos excepto el token.
        $datosBodega = request()->except(['_token', '_method']);

        // Los inserta en la tabla de bodega.
        Bodega::insert($datosBodega);
        $empresas = Api\EmpresaApiController::index();
        //return response()->json($datosBodega); // se retornan los datos en un formato json

        return redirect('bodega')->with('mensaje', 'Bodega agregada'); //vuelve a index y muestra el mensaje
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bodega  $bodega
     * @return \Illuminate\Http\Response
     */
    public function show(Bodega $bodega)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bodega  $bodega
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comunas = Comuna::all();
        $empresas = Api\EmpresaApiController::index();
        $bodega = Bodega::findOrFail($id);

        return view('bodega.edit', compact('empresas', 'bodega', 'comunas')); //se pasan los datos del formulario
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bodega  $bodega
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $comunas = Comuna::all();



        $camposBodega = [

            'id_comuna' => 'required|int|',
            'id_empresa' => 'required|int|',
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|max:100',
            'direccion' => 'required|string|max:50',
            'hora_funcionamiento' => 'required|string|max:30',

        ];

        $mensaje = [
            'required'=>'El :attribute es requerido',
            'nombre.required' => 'El nombre de la bodega es requerido',
            'descripcion.required' => 'El campo descripción es requerido',
            'direccion.required' => 'El campo dirección es requerido',
            'hora_funcionamiento.required' => 'La hora de funcionamiento es requerida',
        ];

        $this->validate($request, $camposBodega, $mensaje);



        $datosBodega = request()->except(['_token', '_method']); //se recepcionan todos los datos a exepcion de token y method

        // Para actualizar datos.
        Bodega::where('id', '=', $id)->update($datosBodega);

        // Retornar datos actualizados.
        $bodega = Bodega::findOrFail($id);
        // return view('bodega.edit',compact('bodega'));

        return redirect('bodega')->with('mensaje', 'Bodega modificada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bodega  $bodega
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Bodega::destroy($id);

        return redirect('bodega')->with('mensaje', 'Bodega eliminada');
    }

    public function bodega_detalle($id)
    {
        return Bodega::findOrFail($id);
    }

    public function obtenercomuna($id)
    {
        return Comuna::findOrFail($id);
    }

    public function obtenerempresa($id)
    {
        //return Api\EmpresaApiController::index()->where('id_empresa','=',$id);
        return Empresa::findOrFail($id);
    }

    public function toIndex()
    {
        return redirect('/');
    }
}
