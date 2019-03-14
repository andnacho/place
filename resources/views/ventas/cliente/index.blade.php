@extends('layouts.admin')

@section('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de clientes  <a name="" id="" class="btn btn-success" href="{{ route('cliente.create')}}" role="button">Nuevo</a></h3>
        @include('ventas.cliente.search')
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
                            <th>fecha</th>
                            <th>Cliente</th>
                            <th>Tipo Doc.</th>
                            <th>Número Doc.</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Opciones</th>
                        </thead>
                    @foreach ($clientes as $cliente)
                                            
                        <tr>
                         
                            <th>{{ $cliente->id }}</th>
                            <th>{{ $cliente->nombre }}</th>
                            <th>{{ $cliente->tipo_documento }}</th>
                            <th>{{ $cliente->num_documento}}</th>
                            <th>{{ $cliente->telefono }}</th>
                            <th>{{ $cliente->email }}</th>
                             
                            <th>
                            {{-- <a name="" id="" class="btn btn-danger" href="{{ route($clienteegoria.destroy', ['id' => $cliente->id]) }}" role="button">Eliminar</a> --}}
                            <a type="button" href="{{ route('cliente.edit', $cliente->id) }}" class="btn btn-primary">Editar</a>
                            <a href="" data-target="#modal-delete-{{ $cliente->id }}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                            </th>
                        </tr>

                            @include('ventas.cliente.modal')

                        @endforeach
                    </table>
                    {{ $clientes->appends([
                        'sort' => 'nombre'                        
                    ])->links() }}
                </div>
            </div>
    </div>
@endsection