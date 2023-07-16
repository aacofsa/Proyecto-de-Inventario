<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    protected $table = 'lote';
    protected $primaryKey = 'id';
    public $incrementing = true;
    
    use HasFactory;

    protected $fillable = [
        'id_producto',
        'id_registro',
        'cantidad',
        'precio_unitario'
    ];
}
