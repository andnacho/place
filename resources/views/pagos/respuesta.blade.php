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
      
    </div>



    <div class="container-fluid row text-center">
        
     <table class="table table-striped table-inverse col-8 mx-auto">
         <thead class="thead-inverse">
             <tr>
                 <th>Referencia</th>
                 <th>Estado</th>
                 <th>Valor</th>
             </tr>
             </thead>
             <tbody>
                 <tr>
                     <td>{{ $response['request']['payment']['reference']}}</td>
                     <td>{{ $response['status']['status'] }}</td>
                     <td>${{ $response['request']['payment']['amount']['total'] }}</td>
                 </tr>
             </tbody>
     </table>
        
    

    </div>

    <script src="{{ asset('js/app.js') }}"></script>


</body>
</html>