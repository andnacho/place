@extends('layouts.admin')

@section('contenido')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <h3>Nueva venta</h3>
            @if(count($errors)>0)
            <div class="alert alert-danger">

                <ul>
                    @foreach ($errors->all() as $error)
                    <li>
                       {{ $error }}
                    </li>
                        
                    @endforeach
                </ul>

            </div>
            @endif
        </div>
        <form id="formIngreso" action="{{ route('ventas.store')}}" method="POST">
            @csrf
            <div class="form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
              <label for="nombre">Cliente</label>
              <select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true">
                @foreach ($personas as $persona)
              <option value="{{ $persona->id }}">{{ $persona->nombre }}</option>
                @endforeach  
              </select>              
            </div>

             <div class="form-group col-lg-4 col-sm-4 col-md-4 col-xs-12">
              <label for="tipo_comprobante">Tipo Comprobante</label>
              <select class="form-control" name="tipo_comprobante" id="tipo_comprobante">
               
               <option value="Boleta">Boleta</option>
               <option value="Factura">Factura</option>
               <option value="Ticket">Ticket</option>

              </select>
            </div>

            <div class="form-group col-lg-4 col-sm-4 col-md-4 col-xs-12">
              <label for="serie_comprobante">Serie Comprobante</label>
              <input type="text"
                class="form-control" name="serie_comprobante" id="serie_comprobante" value="{{ old('serie_comprobante') }}" placeholder="Serie de comprobante"aria-describedby="helpId">
           
            </div>

            <div class="form-group col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <label for="num_comprobante">Número del Comprobante</label>
                <input type="text"
                  class="form-control" name="num_comprobante" id="num_comprobante" required value="{{ old('num_comprobante') }}" placeholder="Numero del comprobante"aria-describedby="helpId">
             
           </div>
          </div>
          <div class="row">
           
            <div class="panel panel-primary">
              <div class="panel-body">
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                    <div class="form-group">
                      <label for="articulo">Articulo</label>  
                      <select name="pidarticulo" id="pidarticulo" class="form-control selectpicker" data-live-search="true">
                          @foreach ($articulos as $articulo)
                          
                            <option value="{{$articulo->id}}_{{ $articulo->stock}}_{{ $articulo->promedio }}">{{ $articulo->nom }}</option>
                          @endforeach  
                        </select>   
                    </div>                  
                </div>
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                  <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="number"
                      class="form-control" name="pcantidad" id="pcantidad" aria-describedby="helpId">

                  </div>
                </div>
                  <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                      <label for="stock">Stock</label>
                      <input type="number"
                        class="form-control" name="pstock" disabled id="pstock" aria-describedby="helpId">
  
                    </div>


                </div>
                
                  <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                      <div class="form-group">
                          <label for="precio_venta">Precio de venta</label>
                          <input type="number" disabled
                            class="form-control" name="pprecio_venta" id="pprecio_venta" disabled aria-describedby="precio de venta">
                       
                        </div>
                    </div>

                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                      <div class="form-group">
                        <label for="descuento">Descuento</label>
                        <input type="number"
                          class="form-control" name="pdescuento" id="pdescuento" aria-describedby="precio">
                     
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                        <div class="form-group">
                        <input type="button" id="bt_add" class="btn btn-primary" value="Agregar">
                          </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                          <thead style="background-color:rgba(0,20,50 ,0.6)">
                            <th>Opciones</th>
                            <th>Artículo</th>
                            <th>Cantidad</th>
                            <th>Precio Venta</th>
                            <th>Descuento</th>
                            <th>Subtotal</th>

                          </thead>
                          <tfoot>
                              <th>Total</th>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th><h4 id="total">$0.0</h4><input type="hidden" name="total_venta" id="total_venta"></th>
                          </tfoot>
                          <tbody>

                          </tbody>
                        </table>
                    </div>
              </div>
            </div>
              
             <div id="guardar" class="container col-lg-12 col-sm-12 col-md-12 col-xs-12">
               
               <button type="submit" class="btn btn-primary ">Guardar</button>
               <a href=" {{ route('proveedor.index') }}"><button type="button" class="btn btn-danger">Cancelar</button></a>
               
              </div>
            </div>
            
        </form>
      
        
   
    @push('scripts')
    
    <script>
   
      
      var cont = 0;
      subtotal = [];
      total=0;
      $("#guardar").hide();
      $('#pidarticulo').change(mostrarValores);

      function mostrarValores()
      {
          datosArticulo = document.getElementById('pidarticulo').value.split('_');
          $('#pprecio_venta').val(datosArticulo[2]);
          $('#pstock').val(datosArticulo[1]);
      }
      
        
       $(document).ready(function(){
      
        $("#bt_add").click(function(){
        agregar();
        
        });
      });

        function agregar(){

          datosArticulo = document.getElementById('pidarticulo').value.split('_');
          
          idarticulo= datosArticulo[0];
          articulo=$('#pidarticulo option:selected').text();
          cantidad=$('#pcantidad').val();
          descuento=$('#pdescuento').val();
          precio_venta=$('#pprecio_venta').val();
          stock = $('#pstock').val();

          resultado = stock - cantidad;
        

          if(idarticulo != "" && articulo != "" && cantidad != "" && descuento != "" && precio_venta != "")
          {
            if(resultado > 0)
            {
            
            subtotal[cont] = (cantidad * precio_venta-descuento);
            total = total + subtotal[cont];
            

    //Variable para agregar nueva fila

            var fila='<tr class="selected" id="fila' + cont + '">'+
            '<td><button class="btn btn-danger btn-xs" type="button" onclick="eliminar'+
            '('+cont+')">X</button></td>'+
            '<td><input form="formIngreso" type="hidden" name="idarticulo[]" value="'+ idarticulo +'">'+ articulo +'</td>'+
            '<td><input form="formIngreso" type="number" readonly name="cantidad[]" value="'+ cantidad +'"></td>'+
            '<td><input form="formIngreso" type="number" readonly name="precio_venta[]" value="'+ precio_venta +'"></td>'+
            '<td><input form="formIngreso" type="number" readonly name="descuento[]" value="'+ descuento +'"></td>'+
            '<td>$ '+ subtotal[cont] +'</td>'+
            '</tr>';  

            cont++;
            limpiar();
            $('#total').html("$ " + total);
            $('#total_venta').val(total);
            evaluar();

            $("#detalles").append(fila);
            }else
            {
              alert("La cantidad a vender supera el Stock");
            }
         


          }else
          {
            alert("Error al ingresar el detalle de la venta, revise los datos del articulo")
          }
        }

        function limpiar(){
          $("#pcantidad").val("");
          $("#pdescuento").val("");
          $("#pprecio_venta").val("");
        }

        function evaluar(){
          if(total>0)
          {
            $("#guardar").show();
          }
          else
          {
            $("#guardar").hide();
          }

        }

        function eliminar(index){
          total=total-subtotal[index];
          $("#total").html("$ " + total);
          $("#total_venta").val(total);
          $("#fila" + index).remove();
          evaluar();
        }

     

    </script>
    @endpush
@endsection