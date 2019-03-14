@extends('layouts.admin')

@section('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de articulos  <a name="" id="" class="btn btn-success" href="{{ route('articulo.create')}}" role="button">Nuevo</a></h3>
        @include('almacen.articulo.search')
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
                            <th>Codigo</th>
                            <th>Categoria</th>
                            <th>Descripción</th>
                            <th>Stock</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </thead>
                    @foreach ($articulos as $articulo)
                                            
                        <tr>
                         
                            <th>{{ $articulo->id }}</th>
                            <th>{{ $articulo->nombre }}</th>
                            <th>{{ $articulo->codigo }}</th>
                            <th>{{ $articulo->categoria}}</th>
                            <th>{{ $articulo->descripcion }}</th>
                            <th>{{ $articulo->stock }}</th>
                            <th>
                                @if($articulo->imagen != "")
                                <img src={{ asset('/imagenes/articulos/' . $articulo->imagen) }} class=" img-thumbnail" style="width:100px; height:100px">
                                @endif
                            </th>
                            <th>{{ $articulo->estado != "0" ? "Activo" : "Inactivo" }} </th>
                            <th style="width:150px">

                                   
                            {{-- <a name="" id="" class="btn btn-danger" href="{{ route($articuloegoria.destroy', ['id' => $articulo->id]) }}" role="button">Eliminar</a> --}}
                            <a type="button" href="{{ route('articulo.edit', $articulo->id) }}" class="btn btn-primary">Editar</a>
                            <a href="" data-target="#modal-delete-{{ $articulo->id }}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                            </th>
                        </tr>

                            @include('almacen.articulo.modal')

                        @endforeach
                    </table>
                    {{ $articulos->appends([
                        'sort' => 'nombre'                        
                    ])->links() }}
                </div>
            </div>
    </div>
@endsection