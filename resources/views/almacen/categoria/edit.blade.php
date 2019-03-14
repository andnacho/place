@extends('layouts.admin')

@section('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

        <h3>Editar Categoria: {{ $categoria->nombre }}</h3>
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

        <form action="{{ route('categoria.update', $categoria->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $categoria->nombre }}">
              
            </div>

            <div class="form-group">
              <label for="descripcion">Descripción</label>
              <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ $categoria->descripcion }}">
              
            </div>

            <button type="submit" class="btn btn-primary">Actualizar categoria</button>
        <a class="btn btn-danger" href={{ route('categoria.index') }}>Cancelar</a>

        </form>

        </div>
    </div>
@endsection