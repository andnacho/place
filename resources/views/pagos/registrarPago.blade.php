<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro de nuevos pagos</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
    
    <div class="container mt-5">
        
    <h1>Ingresa tus datos de compra</h1>

    </div>

    <div class="container row">
        
        <form action="{{ route('pagos.registro') }}" method="post" class="col-10 mx-auto">
            @csrf

            <div class="form-group container">
                <label for="descripcion">Descripción del pago</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripción" aria-describedby="helpId">
                
            </div>
            
            <div class="row">
            <div class="form-group container">
            <label for="moneda" class="col-3">Tipo de moneda</label>
            <select name="moneda" id="moneda" class="col-3">

                <option value="COP">Peso colombiano</option>
                <option value="USD">Dolar</option>
                <option value="EUR">Euro</option>

            </select>
            </div>

            <div class="form-group container">
                <label for="cantidad" class="col-3">Valor del pago</label>
                <input type="number" name="cantidad" id="cantidad" value="0" min="1" class="col-3">
            </div>
          </div>
            
            <input class="btn btn-primary" type="submit" value="Enviar pago">
            
        </form>
        
    </div>

    <script src="{{ asset('js/app.js') }}"></script>


</body>
</html>