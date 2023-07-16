<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresa';
    protected $primaryKey = 'id';
    public $incrementing = true;

    use HasFactory;

    protected $fillable = [
        'rut',
        'nombre',
        'telefono',
        'direccion',
        'correo',
        'rl_rut',
        'rl_nombre',
        'rl_paterno',
        'rl_materno',
        'rl_telefono',
        'rl_correo',
        'activo'
    ];

    public function bodegas(){
        return $this->hasMany(Bodega::class, 'id_empresa', 'id');
    }
}
