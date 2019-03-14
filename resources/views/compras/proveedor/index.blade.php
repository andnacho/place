@extends('layouts.admin')

@section('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de proveedores  <a name="" id="" class="btn btn-success" href="{{ route('proveedor.create')}}" role="button">Nuevo</a></h3>
        @include('compras.proveedor.search')
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
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Tipo Doc.</th>
                            <th>Número Doc.</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Opciones</th>
                        </thead>
                    @foreach ($proveedores as $proveedor)
                                            
                        <tr>
                         
                            <th>{{ $proveedor->id }}</th>
                            <th>{{ $proveedor->nombre }}</th>
                            <th>{{ $proveedor->tipo_documento }}</th>
                            <th>{{ $proveedor->num_documento}}</th>
                            <th>{{ $proveedor->telefono }}</th>
                            <th>{{ $proveedor->email }}</th>
                             
                            <th>
                            {{-- <a name="" id="" class="btn btn-danger" href="{{ route($proveedoregoria.destroy', ['id' => $proveedor->id]) }}" role="button">Eliminar</a> --}}
                            <a type="button" href="{{ route('proveedor.edit', $proveedor->id) }}" class="btn btn-primary">Editar</a>
                            <a href="" data-target="#modal-delete-{{ $proveedor->id }}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                            </th>
                        </tr>

                            @include('compras.proveedor.modal')

                        @endforeach
                    </table>
                    {{ $proveedores->appends([
                        'sort' => 'nombre'                        
                    ])->links() }}
                </div>
            </div>
    </div>
@endsection