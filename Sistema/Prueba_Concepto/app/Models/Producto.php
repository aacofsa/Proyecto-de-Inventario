<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';
    //protected $primaryKey = 'id';
    public $incrementing = true;

    use HasFactory;

    protected $fillable = [
        'id_categoria',
        'nombre',
        'descripcion',
        'dimensiones',
        'stock',
        'peso',
        'foto',
        'precio',
    ];
}
