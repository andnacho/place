<?php

namespace App\Http\Controllers;

use App\PlPay;
use Illuminate\Http\Request;
use Dnetix\Redirection\PlacetoPay;

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
        $request = [
            
            // "paymentMethod" => 'CR_VS',
            

            'payment' => [
                'reference' => $reference,
                'description' => $respuesta->descripcion,
                'amount' => [
                    'currency' => $respuesta->moneda,
                    'total' => $respuesta->cantidad,
                ],

                "allowPartial" => 'TRUE',
            ],

            // "subscription" => [
            //     'reference' => $reference,
            //         'description' => $respuesta->descripcion,
            // ],

            "payer" => [
                "name" => "Kellie Gerhold",
                "surname" => "Yost",
                "email" => "flowe@anderson.com",
                "documentType" => "CC",
                "document" => "1848839248",
                "mobile" => "3006108300",
                "address" => [
                    "street" => "703 Dicki Island Apt. 609",
                    "city" => "North Randallstad",
                    "state" => "Antioquia",
                    "postalCode" => "46292",
                    "country" => "US",
                    "phone" => "363-547-1441 x383"
                ]
            ],
            "buyer" => [
                "name" => "Kellie Gerhold",
                "surname" => "Yost",
                "email" => "flowe@anderson.com",
                "documentType" => "CC",
                "document" => "1848839248",
                "mobile" => "3006108300",
                "address" => [
                    "street" => "703 Dicki Island Apt. 609",
                    "city" => "North Randallstad",
                    "state" => "Antioquia",
                    "postalCode" => "46292",
                    "country" => "US",
                    "phone" => "363-547-1441 x383"
                ]
            ],

            
            'expiration' => date('c', strtotime('+2 days')),
            'returnUrl' => 'http://localhost/placetopay/public/response?reference=' . $reference,
            'ipAddress' => '127.0.0.1',
            'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
        ];
        
           
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
             $placetopay = new Placetopay([
                
                'login' => '6dd490faf9cb87a9862245da41170ff2',
                'tranKey' => '024h1IlD',
                'url' => 'https://test.placetopay.com/redirection',
                'type' => getenv('P2P_TYPE') ?: PlacetoPay::TP_REST
            ]);
            

//Buscara la solicitud basado en la referencia guardada en la base de datos.

            $plsolicitud = PlPay::findOrFail($_GET['reference']);
            
            $response = $placetopay->query($plsolicitud->requestId);
        
            if ($response->isSuccessful()) {
                // In order to use the functions please refer to the RedirectInformation class
        
                if ($response->status()->isApproved()) {
                    // The payment has been approved
                    // print_r($plsolicitud->requestId . " PAYMENT APPROVED\n");
                    // This is additional information about it
                    // print_r($response->toArray());
                } else {
                    // print_r($plsolicitud->requestId . ' ' . $response->status()->message() . "\n");
                }
        
                // print_r($response);
        
            } else {
                // There was some error with the connection so check the message
                print_r($response->status()->message() . "\n");
            }
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
        
        return view('pagos.respuesta', ['response' => $response->toArray()]);
    }

}

