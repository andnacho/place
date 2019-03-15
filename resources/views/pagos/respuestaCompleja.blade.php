@extends('layouts.admin')

@section('contenido')
    

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
                 
                 @if($response->payment !== null)
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
                 @elseif($response->status()->reason() == "?C")
                  <tr>
                        
                        <td>{{ $_GET['reference'] }}</td>
                        <td>CANCELLED</td>
                        <td>{{ $response->requestId() }}</td>
                        <td>{{ $response->requestId() }}</td>
                        <td>Pago cancelado por el usuario</td>
                        <td>No hay pago aún</td>
                         </tr>
                @elseif($response->status()->reason() == "PT")
                        <tr>

                          
                        
                <td>{{ $_GET['reference'] }}</td>
                <td>PENDING</td>
                <td>{{ $response->requestId() }}</td>
                <td>No disponible</td>
                <td>No hay pago aun</td>
              
                        </tr>
                 @endif
                 
             </tbody>
     </table>
       
     <a href="{{ route('ingreso.index') }}" class="btn btn-primary">Regresar al listado de ingresos</a>


    <div>
    <a href="http://www.placetopay.com"><img width="200" src="https://test.placetopay.com/redirection/assets/images/no_logo.svg" style="margin-top:1.5em" alt="Enrique García Molina"></a>
    </div>
    
    </div>
    
    

    @endsection