<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    //
    protected $fillable = [
        'nombre', 'codigo', 'stock', 'descripcion', 'imagen', 'estado'
    ];
}
