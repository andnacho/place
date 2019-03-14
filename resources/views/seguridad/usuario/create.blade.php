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

        <form action="{{ route('usuario.store')}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" name="name" id="nombre" class="form-control" placeholder="Nombre">
              
            </div>

            <div class="form-group">
              <label for="descripcion">Correo electrónico</label>
              <input type="text" name="email" id="descripcion" class="form-control" placeholder="Email">
              
            </div>

            
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña">
                
            </div>
            
            <div class="form-group">
                <label for="password-confirm">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" id="password-confirm" class="form-control" placeholder="Confirmar contraseña">
                
              </div>

            <button type="submit" class="btn btn-primary">Crear nuevo usuario</button>
            <a href="{{ route('usuario.index')}}"><button type="button" class="btn btn-danger">Cancelar</button></a>

        </form>

        </div>
    </div>
@endsection