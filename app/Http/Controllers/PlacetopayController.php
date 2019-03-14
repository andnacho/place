<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dnetix\Redirection\PlacetoPay;

class PlacetopayController extends Controller
{
   
    public function pago(Request $respuesta){

        
        $reference = 'TEST_' . time();
    
        // Request Information, through a PlacetopayRepositorie
        $request = [
           
        ];
        
        try {
            $placetopay = new PlacetoPay([
    
                'login' => '6dd490faf9cb87a9862245da41170ff2',
                'tranKey' => '024h1IlD',
                'url' => 'https://dev.placetopay.com/redirection/',
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
           
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
        
          
        return redirect($response->processUrl);
  
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

