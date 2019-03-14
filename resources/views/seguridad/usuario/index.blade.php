@extends('layouts.admin')

@section('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Usuarios  <a name="" id="" class="btn btn-success" href="{{ route('usuario.create')}}" role="button">Nuevo</a></h3>
        @include('seguridad.usuario.search')
        </div>
    </div>

    <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Opciones</th>
                        </thead>
                    @foreach ($usuarios as $usuario)
                                            
                        <tr>
                            <th>{{ $usuario->id }}</th>
                            <th>{{ $usuario->name }}</th>
                            <th>{{ $usuario->email }}</th>
                            <th style="width:150px">

                                   
                                    <a type="button" href="{{ route('usuario.edit', $usuario->id) }}" class="btn btn-primary">Editar</a>
                                  <a href="" data-target="#modal-delete-{{ $usuario->id }}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                            </th>
                        </tr>

                            @include('seguridad.usuario.modal')

                        @endforeach
                    </table>
                    {{ $usuarios->appends([
                        'sort' => 'nombre'                        
                    ])->links() }}
                </div>
            </div>
    </div>
@endsection