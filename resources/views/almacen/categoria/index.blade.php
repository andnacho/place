@extends('layouts.admin')

@section('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Categorias  <a name="" id="" class="btn btn-success" href="{{ route('categoria.create')}}" role="button">Nuevo</a></h3>
        @include('almacen.categoria.search')
        </div>
    </div>

    <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Opciones</th>
                        </thead>
                    @foreach ($categorias as $cat)
                                            
                        <tr>
                            <th>{{ $cat->id }}</th>
                            <th>{{ $cat->nombre }}</th>
                            <th>{{ $cat->descripcion }}</th>
                            <th style="width:150px">

                                   
                                    {{-- <a name="" id="" class="btn btn-danger" href="{{ route('categoria.destroy', ['id' => $cat->id]) }}" role="button">Eliminar</a> --}}
                                    <a type="button" href="{{ route('categoria.edit', $cat->id) }}" class="btn btn-primary">Editar</a>
                                  <a href="" data-target="#modal-delete-{{ $cat->id }}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                            </th>
                        </tr>

                            @include('almacen.categoria.modal')

                        @endforeach
                    </table>
                    {{ $categorias->appends([
                        'sort' => 'nombre'                        
                    ])->links() }}
                </div>
            </div>
    </div>
@endsection