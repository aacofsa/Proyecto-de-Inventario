<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use Illuminate\Http\Request;

class LoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['lotes']=Lote::paginate(5);
        return view('lote.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('lote.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
            $datosLote= request()->except('_token');
            $coincidencia = Lote::where('id_registro',$request->id_registro)->where('id_producto',$request->id_producto)->get();

            if(count($coincidencia) != 0){
                return view('lote.create');
            }else{
                if( $request->filled('id_producto') && $request->filled('id_registro') && $request->filled('cantidad') && $request->filled('precio_unitario'))
                {
                    Lote::insert($datosLote);
                    return redirect('lote')->with('mensaje','Lote agregado exitosamente');
                }else{
                    return view('lote.create');
                }
            }

            // insertar
                
        //return response()->json($datosLote);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lote  $lote
     * @return \Illuminate\Http\Response
     */
    public function show(Lote $lote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lote  $lote
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $lote=Lote::findOrFail($id);
        return view('lote.edit',compact('lote'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lote  $lote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $coincidencia = Lote::where('id_registro',$request->id_registro)->where('id_producto',$request->id_producto)->get();

            if(count($coincidencia) != 0){
                $lote=Lote::findOrFail($id);
                return view('lote.edit',compact('lote'));
            }else{
                $datosLote= request()->except('_token','_method');
                Lote::where('id','=',$id)->update($datosLote);
                $lote=Lote::findOrFail($id);
                return view('lote.edit',compact('lote'));
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lote  $lote
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Lote::destroy($id);
        return redirect('lote')->with('mensaje','Lote Borrado exitosamente');
    }
}
