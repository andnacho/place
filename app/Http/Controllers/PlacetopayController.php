<?php

namespace App\Http\Controllers;

use App\PlPay;
use App\Ingreso;
use Illuminate\Http\Request;
use Dnetix\Redirection\PlacetoPay;
use App\Repositories\PlacetopayRepositorie;

class PlacetopayController extends Controller
{
  
    //Pagos complejos desde el enlace de localhost/compras/ingreso
  
    public function pagoComplejo(Request $respuesta){
        

        $reference = $respuesta->reference;

        // Request Information, through a PlacetopayRepositorie
        $request = PlacetopayRepositorie::request($respuesta, $reference);
        
           
         try {

            //Credenciales establecidas desde el Repositorio\PlacetopayRepositorie

            $placetopay = new Placetopay(PlacetopayRepositorie::credenciales());


            

            $response = $placetopay->request($request);
        
            if ($response->isSuccessful()) {

                //se crea el registro para la base de datos
                $pp = new PlPay;
                $pp->requestId = $response->requestId();
                $pp->precio_compra = $respuesta->cantidad;
                $pp->refIngreso = $respuesta->reference;
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


public function respuestaCompleja(){
   
    try {
         $placetopay = new Placetopay(PlacetopayRepositorie::credenciales());
        

    //Buscara la solicitud basado en la referencia guardada en la base de datos.
   
    $plsolicitud = PlPay::where('refIngreso',$_GET['reference'])->get()->last();
    
    $response = $placetopay->query($plsolicitud->requestId);

    

        if ($response->status()->isApproved()) {
            
            //si es aprobado
        
           Ingreso::where('serie_comprobante', $response->payment[0]->reference())
           ->update(['estado'=> 'A']);
            
          return view('pagos.respuestaCompleja', ['response' => $response]);

        } elseif($response->status()->isRejected()) {
                     
          
            Ingreso::where('serie_comprobante', $_GET['reference'])
            ->update(['estado'=> 'R']);
            return view('pagos.respuestaCompleja', ['response' => $response]);
        } else{
        
            Ingreso::where('serie_comprobante', $_GET['reference'])
            ->update(['estado'=> 'P']);
            return view('pagos.respuestaCompleja', ['response' => $response]);
        }


    } catch (Exception $e) {
        var_dump($e->getMessage());
        
    }
    

}

//----------------------------------------------------------------//



   //Pagos sencillos desde el link localhost/pagos
    public function pago(Request $respuesta){

       
        
        $reference = PlPay::count();

        // Request Information, through a PlacetopayRepositorie
        $request = PlacetopayRepositorie::request($respuesta, $reference);
        
           
         try {

            //Credenciales establecidas desde el Repositorio\PlacetopayRepositorie

            $placetopay = new Placetopay(PlacetopayRepositorie::credenciales());


            $response = $placetopay->request($request);
        
            if ($response->isSuccessful()) {

                //se crea el registro para la base de datos
                $pp = new PlPay;
                $pp->requestId = $response->requestId();
                $pp->precio_compra = $respuesta->cantidad;
                $pp->idIngreso = $respuesta->idIngreso;
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

