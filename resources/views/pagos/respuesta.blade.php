<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Respuesta bancaria</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
    
    <div class="container mt-5">
        
    <h1>Resumen</h1>
      {{--  {{ dd($response) }}  --}}
    </div>

     <div class="container-fluid row text-center">
        
     <table class="table table-striped table-inverse col-12 mx-auto">
         <thead class="thead-inverse">
             <tr>
                 <th>Referencia</th>
                 <th>Estado</th>
                 <th>Autorizacion/CUS</th>
                 <th>Metodo de pago</th>
                 <th>Valor a Paga</th>
             </tr>
             </thead>
             <tbody>
                 @if(count($response->payment) > 1)
                    @foreach ($response->payment as $pago)
                 <tr>
                  
                     <td>{{ $pago->reference() }}</td>
                     <td>{{ $pago->status()->status() }}</td>
                     <td>{{ $response->requestId() }}</td>
                     <td>{{ $pago->paymentMethodName() }}</td>
                     <td>{{ $pago->amount()->from()->total() }}</td>
                 </tr>
                 @endforeach
                 @else 
                 <tr>
                  
                        <td>{{ $response->payment[0]->reference()  }}</td>
                        <td>{{ $response->payment[0]->status()->status() }}</td>
                        <td>{{ $response->requestId() }}</td>
                        <td>{{ $response->payment[0]->paymentMethodName() }}</td>
                        <td>{{ $response->payment[0]->amount()->from()->total() }}</td>
                         </tr>

                 @endif
                 
             </tbody>
     </table>
        
    <div class="col-2">
     <img src="https://test.placetopay.com/redirection/assets/images/no_logo.svg" alt="Enrique García Molina">
    </div>
    </div>
    
    

    <script src="{{ asset('js/app.js') }}"></script>


</body>
</html>