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
    }

    public static function credenciales(){

        return [
                
            'login' => '6dd490faf9cb87a9862245da41170ff2',
            'tranKey' => '024h1IlD',
            'url' => 'https://test.placetopay.com/redirection',
            'type' => getenv('P2P_TYPE') ?: PlacetoPay::TP_REST
        ];

    }

}