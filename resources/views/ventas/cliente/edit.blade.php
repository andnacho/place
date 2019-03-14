@extends('layouts.admin')

@section('contenido')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <h3>Editar cliente</h3>
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

        <form action="{{ route('cliente.update', $cliente->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required value="{{ $cliente->nombre }}" placeholder="nombre">
              
            </div>

            <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <label for="direccion">Dirección</label>
              <input type="text" name="direccion" id="direccion" class="form-control" required value="{{ $cliente->direccion }}" placeholder="Dirección de residencia">
              
            </div>

            <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <label for="tipo_documento">Tipo de documento</label>
              <select class="form-control" name="tipo_documento" id="tipo_documento">
          
               <option value="ced" @if ($cliente->tipo_documento == 'ced') selected @endif>Cedula de ciudadania</option>
               <option value="tar" @if ($cliente->tipo_documento == 'tar') selected @endif >Tarjeta de identidad</option>
               <option value="pas" @if ($cliente->tipo_documento == 'pas') selected @endif>Pasaporte</option>

              </select>
            </div>

            <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <label for="num_documento">Número de documento</label>
              <input type="text"
                class="form-control" name="num_documento" id="num_documento" required value="{{ $cliente->num_documento }}" placeholder="Número de documento"aria-describedby="helpId">
           
            </div>

            <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <label for="telefono">Teléfono</label>
              <input type="text"
                class="form-control" name="telefono" id="telefono" required value="{{ $cliente->telefono }}" aria-describedby="telefono" placeholder="Teléfono">
             </div>

             <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <label for="email">Email</label>
              <input type="text"
                class="form-control" name="email" id="email" required value="{{ $cliente->email }}" placeholder="Email" aria-describedby="helpId">
             </div>
              
             <div class="container col-lg-12 col-sm-12 col-md-12 col-xs-12">
               
               <button type="submit" class="btn btn-primary ">Ingresar nuevo cliente</button>
               <a href=" {{ route('cliente.index') }}"><button type="button" class="btn btn-danger">Cancelar</button></a>
               
              </div>
        </form>

        </div>
    </div>
@endsection