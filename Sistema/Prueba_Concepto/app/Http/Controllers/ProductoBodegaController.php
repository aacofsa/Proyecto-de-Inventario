<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Bodega;
use App\Models\Producto;
use App\Models\Producto_bodega;
use Illuminate\Http\Request;

class ProductoBodegaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }
    public function seleccionar($id)
    {
        //$datospb['probod'] = Producto_bodega::where('id_bodega', '=', $id)->get();
        // $datosp['productos'] = Producto::where('id', '=', $probod)->get();

        $datos = DB::table('producto_bodegas')->where('id_bodega', '=', $id)
            ->join('producto', 'producto.id', '=', 'producto_bodegas.id_producto')
            ->select('producto_bodegas.*','producto.nombre','producto.id_categoria','producto.descripcion','producto.dimensiones','producto.peso','producto.foto','producto.precio')
            ->get();
        //return response()->json($datos);
          return view('producto_bodega.index',compact('datos'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto_bodega  $producto_bodega
     * @return \Illuminate\Http\Response
     */
    public function show(Producto_bodega $producto_bodega)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto_bodega  $producto_bodega
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto_bodega $producto_bodega)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto_bodega  $producto_bodega
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto_bodega $producto_bodega)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto_bodega  $producto_bodega
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto_bodega $producto_bodega)
    {
        //
    }
}
