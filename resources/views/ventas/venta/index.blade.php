@extends('layouts.admin')

@section('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de ventas <a name="" id="" class="btn btn-success" href="{{ route('ventas.create')}}" role="button">Nuevo</a></h3>
        @include('ventas.venta.search')
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
                            <th>Cliente</th>
                            <th>Comprobante</th>
                            <th>Impuesto</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </thead>
                    @foreach ($ventas as $venta)
                              
                        <tr>
                         
                            <th>{{ $venta->fecha_hora }}</th>
                            <th>{{ $venta->nombre }}</th>
                            <th>{{ $venta->tipo_comprobante. ': '. $venta->serie_comprobante . '-'. $venta->num_comprobante  }}</th>
                             <th>{{ $venta->impuesto }}</th>
                            <th>$ {{ ($venta->total_venta) }}</th>
                            <th>{{$venta->estado == 'A' ? 'Aprobado' : 'Rechazado' }}</th>
                             
                            <th>
                            {{-- <a name="" id="" class="btn btn-danger" href="{{ route($ventaegoria.destroy', ['id' => $venta->id]) }}" role="button">Eliminar</a> --}}
                            <a type="button" href="{{ route('ventas.show', $venta->id) }}" class="btn btn-primary">Detalles</a>
                            <a data-target="#modal-delete-{{ $venta->id }}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
                            </th>
                        </tr>

                            @include('ventas.venta.modal')

                        @endforeach
                    </table>
                    {{ $ventas->appends([
                        'sort' => 'nombre'                        
                    ])->links() }}
                </div>
            </div>
    </div>
@endsection