#Configuración básica para las pruebas

1)Configurar una base de datos con las credenciales especificadas en las variablas de entorno.

2)Ejecutar el comando "php artisan migrate" para migrar las tablas necesarias.

3)Se recomienda usar el comando "php artisan db:seed" para cargar la base de datos y realizar unas pruebas rápidas de la aplicación.

Nota: Si desea realizar el paso 2 y 3 en un solo comando, se puede usar el comando "php artisan migrate --seed"

#Descripción de la aplicación.

Esta aplicación registra ingresos de compras, estos ingresos se hacen en la boton Nuevo, el cual redireccionará a un formulario, una vez insertado los registros deseados se procede a guardar. 

Ya guardado el registro, tendremos en nuestro panel, 3 botones, siempre y cuando el estado diga 'Sin procesar', el boton 'ver pedido' para verificar la canasta de ese pedido, el boton 'pagar' para realizar el pago con ayuda del webservice PlacetoPay/ionion; y el último boton solo estará disponible si el estado se encuentra sin procesar o rechazado, este boton cambia el estado de la base de datos a c, para que no se refleje aquí y no se pierda el registro.

El boton de pago nos redirigira a un formulario que sirve como verificación con el usuario pues estos son los datos relacionados con el pago. 

Nota: Si se desea integrar en el formulario datos personales o automaticamente los datos de la persona que se registre o simplemente algún comportamiento que se desea del webservice, se debe expecificar en la clase App\Repositories\PlacetopayRepositorie, encargada de la estructura de la información.

Una vez realizado el pago, la aplicación se encargará de redirigir al usuario a una vista de verificación, que estará siempre disponible desde el panel.

#Funcionamiento de las clases

##{class}PlacetoPayController
Todo el proceso de pagos es controllado por la clase App\Http\Controllers\PlacetopayController, aquí se encuentran especificado 2 metodos principales y dos de prueba que se encuentran desabilitados.

###{method}pagoComplejo()
El método pagoComplejo(), recibe un Request como parámetro que viene desde el formulario de la vista 'pagos.registraPagoComplejo', (Es aquí donde se vincula la información adicional que se desée pasar al webservice p2p).

Para realizar su funcion, este método hace dos llamados de metodos estáticos request y credenciales de la clase PlacetopayRepositorie (Como se ha dicho es clase es para especificar comportamientos del webservice, manteniendo así un código más limpio) y ejecutará el metodo request() para generar una solicitud de pago.

#code:
   public function pagoComplejo(Request $respuesta){
        

        $reference = $respuesta->reference;

        // Request Information, through a PlacetopayRepositorie
        $request = PlacetopayRepositorie::request($respuesta, $reference);
        
           
         try {

            //Credenciales establecidas desde el Repositorio\PlacetopayRepositorie

            $placetopay = new Placetopay(PlacetopayRepositorie::credenciales());

              $response = $placetopay->request($request);

#           :code#


Si la respuesta recibida desde el webservice es satisfactoria, este método creara una instancia del modelo PlPay, el cual esta encargado de vincular los requestId con el modelo Ingreso, adicionando cualquier valor que sea necesario, por último redireccionará a la Url de PlacetoPay/redirection.

#code:
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

 #           :code#

En caso de que no se pueda procesar, notificará al usuario.

###{method}pagoComplejo()


El método respuestaCompleja(), no recibe parametros desde el invocación del método, no obstante recibe un parametro desde la variable global $_GET.

Despues de haber creado la variable $placetopay con la instanciación de las clases, con esta variable que sirve como referencia, buscará el requestId necesario en la base de datos con ayuda del modelo PlPay, con esta información se solicitará un requestInformation() con el metodo query(), pasando el requestId como parametro.

#code

    $placetopay = new Placetopay(PlacetopayRepositorie::credenciales());
        

    //Buscara la solicitud basado en la referencia guardada en la base de datos.
   
    $plsolicitud = PlPay::where('refIngreso',$_GET['reference'])->get()->last();
    
    $response = $placetopay->query($plsolicitud->requestId);

 #           :code#

 Este mismo método, se encargará de gestionar la respuesta que será recibida por parte del webservice (si se desea se puede crear una clase que se encargue de este proceso), cambiando el tipo de estado del ingreso con ayuda del modelo Ingreso.

 #code

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


 #           :code#

##{class}DatabaseSeeder
Esta clase que viene por defecto en laravel se encargará de llamar las demas clases Seeder, necesarias para las pruebas y que serán creadas luego de usar el comando php artisan db:seed.


#De las vistas

De las vistas cabe mensionar que con ayuda de los controladores, se puede hacer una interacción dinámica con el usuario, y las vistas relacionadas directamente con el controlador de PlaytoPay se encuentran en la ruta de vistas 'pagos'

Se debe tener en cuenta que las vistas utilizadas para este test de la ruta 'pagos', son 'registrarPagoComplejo.blade.php' donde se verifica los detalles del pago antes de realizarlo y 'respuestaCompleja.blade.php' done se muestra al usuario el resumen básico de su compra.

#agradecimientos

Muchas gracias a PlacetoPay por la documentación brindada para este ejercicio, fue de mucha ayuda y es muy completo, ademas agradezco mucho a dnetix por su repositorio git, el cual es utilizado en este ejercicio.

