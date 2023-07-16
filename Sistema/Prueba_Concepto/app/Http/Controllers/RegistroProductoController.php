<?php

namespace App\Http\Controllers;

use App\Models\Registro_producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegistroProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Toma los primeros 30 registros
        $datos['rps']= Registro_producto::paginate(30);

        return view('registro_producto.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('registro_producto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Elimina token del request
        $datosRP = $request->except('_token');

        // Crea validador y valida los datos
        $validator = Validator::make($datosRP,[
                'precio_total'=>'required|integer|min:0',
                'fecha'=>'required|date',
                'tipo'=>'required|in:compra,venta',
                'factura'=>'nullable|string',
        ]);

        // Si falla la validacion retorna con errores
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Agrega nueva entreada a la tabla de Registro producto
        Registro_producto::insert($datosRP);
        return redirect('registro_producto')->with('mensajeSuccess','Registro de producto creado');;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registro_producto  $Registro_producto
     * @return \Illuminate\Http\Response
     */
    public function show(Registro_producto $Registro_producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registro_producto  $Registro_producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rp = Registro_Producto::findOrFail($id);
        return view('registro_producto.edit',compact('rp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registro_producto  $Registro_producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosRP = request()->except(['_token','enviar','_method']);

        $validator = Validator::make($datosRP,[
            'precio_total'=>'required|integer|min:0',
            'fecha'=>'required|date',
            'tipo'=>'required|in:compra,venta',
            'factura'=>'nullable|integer',
        ]);
    
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Registro_producto::where('id','=',$id)->update($datosRP);

        $rp = Registro_Producto::findOrFail($id);
        return redirect('registro_producto')->with('mensajeSuccess','Registro de producto editado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registro_producto  $Registro_producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Registro_producto::destroy($id);
        return redirect('registro_producto')->with('mensajeSuccess','Registro de producto eliminado');
    }
}