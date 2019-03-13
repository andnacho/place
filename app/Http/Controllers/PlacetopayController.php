<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dnetix\Redirection\PlacetoPay;

class PlacetopayController extends Controller
{
   
    public function pago(){

        $reference = 'TEST_' . time();
    
        // Request Information
        $request = [
            "locale" => "es_CO",
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
            "payment" => [
                "reference" => $reference,
                "description" => "Iusto sit et voluptatem.",
                "amount" => [
                    "taxes" => [
                        [
                            "kind" => "ice",
                            "amount" => 56.4,
                            "base" => 470
                        ],
                        [
                            "kind" => "valueAddedTax",
                            "amount" => 89.3,
                            "base" => 470
                        ]
                    ],
                    "details" => [
                        [
                            "kind" => "shipping",
                            "amount" => 47
                        ],
                        [
                            "kind" => "tip",
                            "amount" => 47
                        ],
                        [
                            "kind" => "subtotal",
                            "amount" => 940
                        ]
                    ],
                    "currency" => "USD",
                    "total" => 1076.3
                ],
                "items" => [
                    [
                        "sku" => 26443,
                        "name" => "Qui voluptatem excepturi.",
                        "category" => "physical",
                        "qty" => 1,
                        "price" => 940,
                        "tax" => 89.3
                    ]
                ],
                "shipping" => [
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
                "allowPartial" => false
            ],
            "expiration" => date('c', strtotime('+1 hour')),
            "ipAddress" => "127.0.0.1",
            "userAgent" => "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36",
            "returnUrl" => "http://dnetix.dev/p2p/client",
            "cancelUrl" => "https://dnetix.co",
            "skipResult" => false,
            "noBuyerFill" => false,
            "captureAddress" => false,
            "paymentMethod" => null
        ];
        
        try {
            $placetopay = new PlacetoPay([
    
                'login' => '6dd490faf9cb87a9862245da41170ff2',
                'tranKey' => '024h1IlD',
                'url' => 'https://test.placetopay.com/redirection',
                'type' => getenv('P2P_TYPE') ?: PlacetoPay::TP_REST
    
            ]);
    
            $response = $placetopay->request($request);
        
            if ($response->isSuccessful()) {
                // Redirect the client to the processUrl or display it on the JS extension
                // $response->processUrl();
            } else {
                // There was some error so check the message
                // $response->status()->message();
            }
            var_dump($response);
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
        
          
         return view('rest', compact('response'));
  
}
    
    
    public function consultar(){
        if (isset($argv)) {
            // Called from the CLI
            if (!isset($argv[1]) || !is_numeric($argv[1])) {
                print_r("Usage: php examples/basic/information.php REQUEST_ID\n");
                print_r("REQUEST_ID should be replaced by the requestId wanted to query\n");
                die();
            }
            $requestId = $argv[1];
        } else {
            // Called from browser
            if (!isset($_GET['requestId']) || !is_numeric($_GET['requestId'])) {
                print_r("Please include requestId as a GET parameter with the requestId to be queried");
                die();
            }
            $requestId = $_GET['requestId'];
        }
        /**
         * END OF IGNORE
         */
        
        try {
            $response = new PlacetoPay([
    
                'login' => '6dd490faf9cb87a9862245da41170ff2',
                'tranKey' => '024h1IlD',
                'url' => 'https://test.placetopay.com/redirection',
                'type' => getenv('P2P_TYPE') ?: PlacetoPay::TP_REST
    
            ]);
            
            $response->query($requestId);
        
            if ($response->isSuccessful()) {
                // In order to use the functions please refer to the RedirectInformation class
        
                if ($response->status()->isApproved()) {
                    // The payment has been approved
                    print_r($requestId . " PAYMENT APPROVED\n");
                    // This is additional information about it
                    print_r($response->toArray());
                } else {
                    print_r($requestId . ' ' . $response->status()->message() . "\n");
                }
        
                print_r($response);
        
            } else {
                // There was some error with the connection so check the message
                print_r($response->status()->message() . "\n");
            }
        } catch (Exception $e) {
            var_dump($e->getMessage() . "hola");
        }
        
        
    }
    
}

