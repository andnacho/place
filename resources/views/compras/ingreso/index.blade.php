@extends('layouts.admin')

@section('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Ingresos <a name="" id="" class="btn btn-info" href="{{ route('ingreso.create')}}" role="button">Nuevo</a></h3>
        @include('compras.ingreso.search')
        </div>
    </div>

    @if(session()->has('actualizado'))
       
    <div class="alert alert-info alert-dismissible" style="width:30%">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{session('actualizado')}}</strong> 
          </div>
       
    @endif

    <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <th>Fecha</th>
                            <th>Proveedor</th>
                            <th>Comprobante</th>
                            <th>Impuesto</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </thead>
                    @foreach ($ingresos as $ingreso)
                              
                        <tr>
                         
                            <th>{{ $ingreso->fecha_hora }}</th>
                            <th>{{ $ingreso->nombre }}</th>
                            <th>{{ $ingreso->tipo_comprobante. ': '. $ingreso->serie_comprobante . '-'. $ingreso->num_comprobante  }}</th>
                             <th>{{ $ingreso->impuesto }}</th>
                            <th>$ {{ ($ingreso->total) }}</th>
                            <th>{{ $ingreso->estado($ingreso->estado) }}</th>
                             
                            <th>
                            {{-- <a name="" id="" class="btn btn-danger" href="{{ route($ingresoegoria.destroy', ['id' => $ingreso->id]) }}" role="button">Eliminar</a> --}}
                            <a type="button" href="{{ route('ingreso.show', $ingreso->id) }}" class="btn btn-primary">Ver pedido</a>
                            
                           

                            {{--  Si el pago ya esta aprobado no se mostrara el boton de pagar  --}}
                            @if ($ingreso->estado != 'A')
                            <a type="button" href="{{ route('ingreso.pagar', $ingreso->id) }}" class="btn btn-success">Pagar</a>
                            <a data-target="#modal-delete-{{ $ingreso->id }}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
                            @else
                            <a type="button" href="http://localhost/response?reference={{$ingreso->serie_comprobante }}" class="btn btn-success">Ver pago</a>
                            @endif

                            </th>
                        </tr>

                            @include('compras.ingreso.modal')

                        @endforeach
                    </table>
                    {{ $ingresos->appends([
                        'sort' => 'nombre'                        
                    ])->links() }}
                </div>
            </div>
    </div>
@endsection