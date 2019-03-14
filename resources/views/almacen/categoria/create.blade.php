@extends('layouts.admin')

@section('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <h3>Nueva Categoria</h3>
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

        <form action="{{ route('categoria.store')}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" name="nombre" id="nombre" class="form-control" placeholder="nombre">
              
            </div>

            <div class="form-group">
              <label for="descripcion">Descripción</label>
              <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="descripción del producto">
              
            </div>

            <button type="submit" class="btn btn-primary">Crear nueva categoria</button>
            <a href="{{ route('categoria.index')}}"><button type="button" class="btn btn-danger">Cancelar</button></a>

        </form>

        </div>
    </div>
@endsection