<?php

namespace App\Http\Controllers;

use App\Mail\Prueba;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MensajesController extends Controller
{
    //
    public function detalles(Request $request){
        
         Mail::to($request->user()->email)
        ->send(new Prueba($request));

         return (new Prueba($request))->render();
    }
}
