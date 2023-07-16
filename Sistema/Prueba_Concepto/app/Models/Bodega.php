<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bodega extends Model
{
    protected $table = 'bodega';
    protected $primaryKey = 'id';
    public $incrementing = true;

    use HasFactory;

    public function productos(){
        return $this->hasMany(Producto::class, 'id_bodega', 'id');
    }

    public function empresa(){
        return $this->belongsTo(Empresa::class, 'id_empresa','id');
    }

    public function comuna(){
        return $this->belongsTo(Comuna::class, 'id_comuna', 'id');
    }
}
