<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto_bodega extends Model
{   protected $table = 'producto_bodegas';
    protected $primaryKey = 'id';
    public $incrementing = true;

    use HasFactory;

    protected $fillable = [

        'id_bodega',
        'id_producto',
        'stock'
    ];
    
}
