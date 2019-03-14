@extends('layouts.admin')

@section('contenido')
    
       
            <div class="form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
              <label for="nombre">Proveedor</label>
            <p>{{ $ingresos->nombre }}</p>       
            </div>

             <div class="form-group col-lg-4 col-sm-4 col-md-4 col-xs-12">
              <label>Tipo Comprobante</label>
              <p>{{ $ingresos->tipo_comprobante }}</p>   
            </div>

            <div class="form-group col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <label>Serie Comprobante</label>  
              <p>{{ $ingresos->serie_comprobante }}</p>   
           
            </div>

            <div class="form-group col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <label>Número Comprobante</label> 
              <p>{{ $ingresos->num_comprobante }}</p>   
           </div>
          </div>
          <div class="row">
           
            <div class="panel panel-primary">
              <div class="panel-body">
            
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                          <thead style="background-color:rgba(0,20,50 ,0.6)">
                            
                            <th>Artículo</th>
                            <th>Cantidad</th>
                            <th>Precio Compra</th>
                            <th>Precio Venta</th>
                            <th>Subtotal</th>

                          </thead>
                          <tfoot>
                             
                              <th></th>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th><h4 id="total">{{ '$' . $ingresos->total }}</h4></th>
                          </tfoot>
                          <tbody>
                              @foreach ($detalles as $detalle)
                                 <tr>
                                 <td>{{ $detalle->articulo }}</td>
                                 <td>{{ $detalle->cantidad }}</td>
                                 <td>{{ $detalle->precio_compra }}</td>
                                 <td>{{ $detalle->precio_venta }}</td>
                                 <td>{{ $detalle->cantidad * $detalle->precio_compra }}</td>   
                                </tr> 
                              @endforeach
                          </tbody>
                        </table>
                    </div>
              </div>
            </div>
     
  
@endsection