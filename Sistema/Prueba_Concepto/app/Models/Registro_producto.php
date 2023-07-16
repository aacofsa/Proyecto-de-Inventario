<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro_producto extends Model
{
    protected $table = 'registro_producto';
    protected $primaryKey = 'id';
    public $incrementing = true;

    use HasFactory;

    protected $fillable = [
        'precio_total',
        'fecha',
        'tipo',
        'factura'
    ];
}