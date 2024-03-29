<?php 


namespace App\Repositories;

use Dnetix\Redirection\PlacetoPay;

class PlacetopayRepositorie
{

    //Con este repositorio se trabajara de
    //manera separa las especificaciones que 
    //tendra el request
    
    public static function request($respuesta, $reference){

        return [
                      
            'payment' => [
                'reference' => $reference,
                'description' => $respuesta->descripcion,
                'amount' => [
                    'currency' => $respuesta->moneda,
                    'total' => $respuesta->cantidad,
                ],

                // "allowPartial" => 'TRUE',
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
            'returnUrl' => 'http://localhost/response?reference=' . $reference,
            
            'ipAddress' => PlacetopayRepositorie::saberIp(),
            // 'ipAddress' => '192.168.1.10', //Para pruebas

            'userAgent' => $_SERVER['HTTP_USER_AGENT']
            // 'userAgent' =>  'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', //pruebas

        ];
    }

    public static function credenciales(){

        return [
                
            'login' => '6dd490faf9cb87a9862245da41170ff2',
            'tranKey' => '024h1IlD',
            'url' => 'https://test.placetopay.com/redirection',
            'type' => getenv('P2P_TYPE') ?: PlacetoPay::TP_REST
        ];

    }

    //Para saber el ip
    static private function saberIp(){

         if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
           
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
       
        return $_SERVER['REMOTE_ADDR'];
    }

}