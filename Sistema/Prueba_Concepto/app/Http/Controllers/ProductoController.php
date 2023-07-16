<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ProductoController extends Controller
{
    public function index()
    {
        $categoria = Categoria::all();

        $datos['producto'] = Producto::all();

        return view('producto.index', $datos, compact('categoria'));
    }

    public function create()
    {
        $categoria = Categoria::all();
        return view('producto.create', compact('categoria'));
    }

    public function store(Request $request)
    {


        $categoria = Categoria::all();

        $datoproducto = request()->except('_token');

        $validatorProduct = Validator::make($datoproducto,[
            'id_categoria' => 'required|int|',
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|max:100',
            'dimensiones' => 'required|string|max:50',
            'stock' => 'required|int|',
            'peso' => 'required|int|',
            'foto' => 'required|max:10000|mimes:jpeg,png,jpg',
            'precio' => 'required|int|',
        ]);

        if($validatorProduct->fails()){
            return redirect()->back()->withErrors($validatorProduct)->withInput();
        }

        if ($request->hasFile('foto')) {
            $datoproducto['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        Producto::insert($datoproducto);

        return redirect('producto')->with('mensaje', 'Producto agregado con éxito');
    }

    public function show(Producto $producto)
    {
        //
    }

    public function edit($id)
    {
        $categoria = Categoria::all();

        $producto = Producto::findOrFail($id);

        return view('producto.edit', compact('producto', 'categoria'));
    }

    public function update(Request $request, $id)
    {
        $producto = request()->except(['_token', '_method']);

        $validatorProduct = Validator::make($producto,[
            'id_categoria' => 'required|int|',
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|max:100',
            'dimensiones' => 'required|string|max:50',
            'stock' => 'required|int|',
            'peso' => 'required|int|',
            'foto' => 'required|max:10000|mimes:jpeg,png,jpg',
            'precio' => 'required|int|',
        ]);

        if($validatorProduct->fails()){
            return redirect()->back()->withErrors($validatorProduct)->withInput();
        }

        $datoproducto = Producto::findOrFail($id);

        if ($request->hasFile('foto')) {

            Storage::delete('public/' . $datoproducto->foto);

            $producto['foto'] = $request->file('foto')->store('uploads', 'public');
        }


        Producto::where('id', '=', $id)->update($producto);


        return redirect('producto')->with('mensaje', 'Producto Modificado');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);

        if (Storage::delete('public/' . $producto->foto)) {

            Producto::destroy($id);
        } else {

            Producto::destroy($id);
        }

        return redirect('producto')->with('mensaje', 'Producto borrado con éxito');
    }
}
