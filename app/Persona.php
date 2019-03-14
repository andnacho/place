<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    protected $fillable = [
        'tipo_persona', 'nombre', 'tipo_documento', 'num_documento', 'direccion', 'telefono', 'email'
    ];

}
