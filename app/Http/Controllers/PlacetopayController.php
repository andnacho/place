<?php

namespace App\Http\Controllers;

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

       
        
        $reference = '123';
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
           
    
            $response = $placetopay->request($request);
        
            if ($response->isSuccessful()) {
                
                $requestId = $response->requestId();
               
                $response->processUrl();
            } else {
                // There was some error so check the message
                $response->status()->message();
            }
           
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
      

         try {
            $placetopay = new Placetopay([
                
                'login' => '6dd490faf9cb87a9862245da41170ff2',
                'tranKey' => '024h1IlD',
                'url' => 'https://test.placetopay.com/redirection',
                'type' => getenv('P2P_TYPE') ?: PlacetoPay::TP_REST
            ]);

            $response = $placetopay->request($request);
        
            if ($response->isSuccessful()) {
                // Redirect the client to the processUrl or display it on the JS extension
                $response->processUrl();
            } else {
                // There was some error so check the message
                // $response->status()->message();
            }
            var_dump($response);
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
        
       

        return redirect($response->processUrl());
  
}
    
    
    public function consultar(){
     dd($this->placetopay->query(1552542892));
    }

    public function respuesta(){

        try {
             $placetopay = new Placetopay([
                
                'login' => '6dd490faf9cb87a9862245da41170ff2',
                'tranKey' => '024h1IlD',
                'url' => 'https://test.placetopay.com/redirection',
                'type' => getenv('P2P_TYPE') ?: PlacetoPay::TP_REST
            ]);
            
            $response = $placetopay->query($this->requestId);
        
            if ($response->isSuccessful()) {
                // In order to use the functions please refer to the RedirectInformation class
        
                if ($response->status()->isApproved()) {
                    // The payment has been approved
                    print_r($this->requestId . " PAYMENT APPROVED\n");
                    // This is additional information about it
                    print_r($response->toArray());
                } else {
                    print_r($this->requestId . ' ' . $response->status()->message() . "\n");
                }
        
                print_r($response);
        
            } else {
                // There was some error with the connection so check the message
                print_r($response->status()->message() . "\n");
            }
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
        
        dd($this->requestId);

        return view('pagos.respuesta', compact('response'));
    }

}

