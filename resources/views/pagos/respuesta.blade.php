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

{{ dd($response)}}

    <div class="container-fluid row text-center">
        
     <table class="table table-striped table-inverse col-8 mx-auto">
         <thead class="thead-inverse">
             <tr>
                 <th>Descripción</th>
                 <th>Valor</th>
                 <th>Moneda</th>
             </tr>
             </thead>
             <tbody>
                 <tr>
                     <td></td>
                     <td></td>
                     <td></td>
                 </tr>
             </tbody>
     </table>
        
    

    </div>

    <script src="{{ asset('js/app.js') }}"></script>


</body>
</html>