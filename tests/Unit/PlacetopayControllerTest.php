<?php

namespace Tests\Unit;

use Mockery;
use App\PlPay;
use Tests\TestCase;
use Illuminate\Http\Request;
use Dnetix\Redirection\PlacetoPay;
use App\Repositories\PlacetopayRepositorie;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\PlacetopayController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PlacetopayControllerTest extends TestCase
{
    use DatabaseMigrations;

    //Nota importante: si se va a utilizar este test, se deben
    // comentar y descomentar los atributos del 
    //PlatetoPayRepositorie que tienen que ver con las variables de entorno.
  
    /** @before */
    public function crear()
    {
        
    }

    //probar el pagoComplejo metodo
    /**
     * @backupGlobals enabled
     */
      public function testPagoComplejo()
    {  

        
        $respuesta = new Request([
            'descripcion' => 'algo',
            'moneda' => 'COP',
            'cantidad' => 2500,
            'reference' => 2525154,
                        
        ]);
       
        $controller = new PlacetopayController($respuesta);

        $request = PlacetopayRepositorie::request($respuesta, $respuesta->reference);
        
        $this->assertTrue(count($request) > 0);

        $placetopay = new Placetopay(PlacetopayRepositorie::credenciales());


            try{

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
        
    }
}
