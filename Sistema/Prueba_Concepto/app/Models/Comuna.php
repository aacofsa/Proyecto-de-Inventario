<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{   protected $table = 'comuna';
    protected $primaryKey = 'id';
    public $incrementing = true;

    use HasFactory;

    protected $fillable = [
        'nombre',
        'id_region',
    ];

    public function bodegas(){
        return $this->hasMany(Bodega::class, 'id_comuna', 'id');
    }

    public function region(){
        return $this->belongsTo(Region::class, 'id_region', 'id');
    }
}
