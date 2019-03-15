@extends('layouts.admin')

@section('title', 'pagos')

@section('contenido')

  
    <div class="col-10" style="padding:2%">
            <h1 >Realizar pago</h1>


    <form action="{{ route('pagos.registro') }}"  method="post" class="col-10 mx-auto">
            @csrf
            
            <div class="form-group container">
                <label for="descripcion">Descripción del pago
                <input type="text" name="descripcion" id="descripcion" class="form-control" value="Compra a {{ $ingresos->nombre }}" readonly aria-describedby="helpId">
            </label>
            </div>
            
            <div class="form-group container">
                    <label for="reference">Referencia
                    <input type="text" name="reference" id="reference" class="form-control" value="{{ $ingresos->serie_comprobante }}" readonly>
                  </label>
                  </div>
      
          <input type="number" name="idIngreso" value='{{ $ingresos->id }}' hidden></input>
            
            <div class="form-group container">
            <label for="moneda" class="col-3">Tipo de moneda</label>
            <select name="moneda" id="moneda" class="col-3" aria-readonly="true">

                <option value="COP">Peso colombiano</option>
                {{--  <option value="USD">Dolar</option>
                <option value="EUR">Euro</option>  --}}

            </select>
            </div>

            
            <div class="form-group container">
                <label for="cantidad" class="col-3">Valor del pago</label>
                <input type="number" name="cantidad" id="cantidad" value="{{$ingresos->total}}" readonly class="col-3">
            </div>
          
            
            <input class="btn btn-success col-2" type="submit" value="Realizar pago" style="margin-left:1em">
                 
     <a href="{{ route('ingreso.index') }}" class="btn btn-primary">Regresar al listado de ingresos</a>

        </form>
        
        
            <div class="container col-5" style="margin-top:2em">
                <a href="http://www.placetopay.com"><img class="" width="200" src="https://test.placetopay.com/redirection/assets/images/no_logo.svg" alt="Enrique García Molina"></a>
            </div>
            
            
      
    </div>
        

          
@endsection