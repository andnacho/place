@extends('layouts.admin')

@section('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

        <h3>Editar usuario: {{ $usuario->nombre }}</h3>
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

        <form action="{{ route('usuario.update', $usuario->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                    <label for="nombre">Nombre</label>
            <input type="text" name="name" id="nombre" class="form-control" value="{{ $usuario->name }}">
                    
                  </div>
      
                  <div class="form-group">
                    <label for="descripcion">Correo electrónico</label>
                    <input type="text" name="email" id="descripcion" class="form-control" value="{{ $usuario->email }}">
                    
                  </div>
      
                  
                  <div class="form-group">
                      <input type="hidden" name="password" id="password" class="form-control" placeholder="Contraseña">
                      
                  </div>
                  
                  <div class="form-group">
                    
                      <input type="hidden" name="password_confirmation" id="password-confirm" class="form-control" placeholder="Confirmar contraseña">
                      
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('usuario.index')}}"><button type="button" class="btn btn-danger">Cancelar</button></a>

        </form>

        </div>
    </div>
@endsection