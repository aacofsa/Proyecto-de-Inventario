<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acceso_Bodega extends Model
{
    protected $table = 'acceso_bodega';
    protected $primaryKey = 'id';
    public $incrementing = true;
    
    use HasFactory;

    protected $fillable = [
        'email_usuario',
        'id_bodega',
        'activo'
    ];
}
