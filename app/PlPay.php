<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlPay extends Model
{
    //

    protected $table = 'plpays';

    protected $fillable = [
        'id', 'requestId', 'precio_compra',
    ];
}
