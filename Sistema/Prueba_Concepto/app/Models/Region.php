<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{   protected $table = 'region';
    protected $primaryKey = 'id';
    public $incrementing = true;

    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    public function comunas(){
        return $this->hasMany(Comuna::class, 'id_region', 'id');
    }
}
