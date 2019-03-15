<?php

namespace App\Http\Controllers;

use App\PlPay;
use Illuminate\Http\Request;
use Dnetix\Redirection\PlacetoPay;
use App\Repositories\PlacetopayRepositorie;

class PlacetopayController extends Controller
{
      
    public $placetopay;
     
    
    
    public function __construct()
    {
  

    $this->placetopay = new PlacetoPay(
        [

        'login' => '6dd490faf9cb87a9862245da41170ff2',
        'tranKey' => '024h1IlD',
        'url' => 'https://dev.placetopay.com/redirection',
        'type' => getenv('P2P_TYPE') ?: PlacetoPay::TP_REST

    ]
);
    
    }

   
    public function pago(Request $respuesta){

       
        
        $reference = PlPay::count() + 1;

        // Request Information, through a PlacetopayRepositorie
        $request = PlacetopayRepositorie::request($respuesta, $reference);
        
           
         try {
            $placetopay = new Placetopay([
                
                'login' => '6dd490faf9cb87a9862245da41170ff2',
                'tranKey' => '024h1IlD',
                'url' => 'https://test.placetopay.com/redirection',
                'type' => getenv('P2P_TYPE') ?: PlacetoPay::TP_REST
            ]);

            $response = $placetopay->request($request);
        
            if ($response->isSuccessful()) {

                //se crea el registro para la base de datos
                $pp = new PlPay;
                $pp->requestId = $response->requestId();
                $pp->precio_compra = $respuesta->cantidad;
                $pp->save();

                return redirect($response->processUrl());
            } else {
                // There was some error so check the message
                // $response->status()->message();
            }
            var_dump($response);
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }  

        return 'No se pudo procesar su solicitud';
  
}
    
    
     public function respuesta(){

        try {
             $placetopay = new Placetopay(PlacetopayRepositorie::credenciales());
            

        //Buscara la solicitud basado en la referencia guardada en la base de datos.

            $plsolicitud = PlPay::findOrFail($_GET['reference']);
            
            $response = $placetopay->query($plsolicitud->requestId);
        
            return view('pagos.respuesta', ['response' => $response]);

        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
        
   
    }

}

