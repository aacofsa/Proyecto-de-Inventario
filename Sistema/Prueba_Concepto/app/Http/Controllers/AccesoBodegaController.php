<?php

namespace App\Http\Controllers;

use App\Models\Acceso_Bodega;
use Illuminate\Http\Request;

class AccesoBodegaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['acceso_bodegas']=Acceso_Bodega::paginate(5);
        return view('acceso_bodega.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('acceso_bodega.create');
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
        $datosaccesobodega=request()->except('_token');
        if($request->has('activo')){
            $datosaccesobodega['activo'] = true;
        } else {
            $datosaccesobodega['activo'] = false;
        }
        $coincidencia = Acceso_Bodega::where('email_usuario',$request->email_usuario)->where('id_bodega',$request->id_bodega)->get();

            if(count($coincidencia) != 0){
                return view('acceso_bodega.create');
            }else{
                if( $request->filled('email_usuario') && $request->filled('id_bodega'))
                {
                    Acceso_Bodega::insert($datosaccesobodega);
                    return redirect('acceso_bodega')->with('mensaje','Acceso Bodega agregado exitosamente');
                }else{
                    return view('acceso_bodega.create');
                }
            }
        //Acceso_Bodega::insert($datosaccesobodega);
        //return response()->json($datosaccesobodega);
        //return redirect('acceso_bodega')->with('mensaje','Acceso a bodega agregado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Acceso_Bodega  $acceso_Bodega
     * @return \Illuminate\Http\Response
     */
    public function show(Acceso_Bodega $acceso_Bodega)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Acceso_Bodega  $acceso_Bodega
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $acceso_bodega=Acceso_Bodega::findOrFail($id);
        return view('acceso_bodega.edit', compact('acceso_bodega'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Acceso_Bodega  $acceso_Bodega
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $coincidencia = Acceso_Bodega::where('email_usuario',$request->email_usuario)->where('id_bodega',$request->id_bodega)->get();
            
            if(count($coincidencia) != 0){
                $acceso_bodega=Acceso_Bodega::findOrFail($id);
                return view('acceso_bodega.edit',compact('acceso_bodega'));
            }else{
                $datosaccesobodega= request()->except('_token','_method');
                if($request->has('activo')){
                    $datosaccesobodega['activo'] = true;
                } else {
                    $datosaccesobodega['activo'] = false;
                }
                Acceso_Bodega::where('id','=',$id)->update($datosaccesobodega);
                $acceso_bodega=Acceso_Bodega::findOrFail($id);
                return view('acceso_bodega.edit',compact('acceso_bodega'));
            }
        //Acceso_Bodega::where('id','=',$id)->update($datosaccesobodega);

        //$acceso_bodega=Acceso_Bodega::findOrFail($id);
        //return view('acceso_bodega.edit', compact('acceso_bodega'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Acceso_Bodega  $acceso_Bodega
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Acceso_Bodega::destroy($id);
        return redirect('acceso_bodega')->with('mensaje','Acceso a bodega borrado');
    }
}
