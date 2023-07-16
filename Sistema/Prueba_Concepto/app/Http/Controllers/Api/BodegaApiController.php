<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bodega;
use Illuminate\Support\Facades\DB;

class BodegaApiController extends Controller
{
    public function export($id, Request $request)
    {
        $bodega = Bodega::find($id);
        if (!$bodega) {
            abort(404, 'Bodega no encontrada');
        }

        $productos = DB::table('producto_bodegas')
            ->select(['producto_bodegas.stock as stock', 'producto.id as id', 'producto.nombre as nombre', 'producto.precio as precio'])
            ->join('producto', 'producto.id', '=', 'producto_bodegas.id_producto')
            ->where('producto_bodegas.id_bodega', '=', $id)
            ->distinct()
            ->get();
        // 2021-11-25 00:18:26
        $now_splited = explode(" ", now());
        // 2021_11_25
        $date = str_replace("-", "_", $now_splited[0]);
        // 001826
        $hours = str_replace(":", "", $now_splited[1]);
        $now = $date . '_' . $hours;
        // nombrado de archivo y path
        $filename = $bodega->nombre . '_' . $now . '.csv';
        $filename = str_replace(" ", "_", $filename);

        $path = storage_path() . '/app/public/' . $filename;
        error_log($path);
        // se abre el archivo con persimos de append y lectura (append crea el archivo si no existe)
        $file = fopen($path, 'a+');
        $columns = array('ID', 'Nombre', 'Stock', 'Precio de venta');
        // le añade las columnas al nuevo archivo
        fputcsv($file, $columns);
        // recorremos los productos a exportar
        foreach ($productos as $producto) {
            $row['ID'] = $producto->id;
            $row['Nombre'] = $producto->nombre;
            $row['Stock']  = $producto->stock;
            $row['precio_venta']  = $producto->precio;

            // se le añade al archivo la nueva fila
            fputcsv($file, array($row['ID'], $row['Nombre'], $row['Stock'], $row['precio_venta']));
        }
        // siempre se tiene que cerrar el archivo
        fclose($file);
        // se configuran los header para la descarga del archivo
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=" . $filename,
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        // se envia el archivo por metodo download para que descargue automaticamente en el front
        return response()->download($path, $filename, $headers);
    }
}
