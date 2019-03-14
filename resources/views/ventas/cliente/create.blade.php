@extends('layouts.admin')

@section('contenido')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <h3>Nuevo cliente</h3>
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

        <form action="{{ route('cliente.store')}}" method="POST">
            @csrf
            <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required value="{{ old('nombre') }}" placeholder="nombre">
              
            </div>

            <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <label for="direccion">Dirección</label>
              <input type="text" name="direccion" id="direccion" class="form-control" required value="{{ old('direccion') }}" placeholder="Dirección de residencia">
              
            </div>

            <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <label for="tipo_documento">Tipo de documento</label>
              <select class="form-control" name="tipo_documento" id="tipo_documento">
               <option value="ced">Cedula de ciudadania</option>
               <option value="tar">Tarjeta de identidad</option>
               <option value="pas">Pasaporte</option>

              </select>
            </div>

            <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <label for="num_documento">Número de documento</label>
              <input type="text"
                class="form-control" name="num_documento" id="num_documento" required value="{{ old('num_documento') }}" placeholder="Número de documento"aria-describedby="helpId">
           
            </div>

            <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <label for="telefono">Teléfono</label>
              <input type="text"
                class="form-control" name="telefono" id="telefono" required value="{{ old('telefono') }}" aria-describedby="telefono" placeholder="Teléfono">
             </div>

             <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <label for="email">Email</label>
              <input type="text"
                class="form-control" name="email" id="email" required value="{{ old('email') }}" placeholder="Email" aria-describedby="helpId">
             </div>
              
             <div class="container col-lg-12 col-sm-12 col-md-12 col-xs-12">
               
               <button type="submit" class="btn btn-primary ">Ingresar nuevo cliente</button>
               <a href=" {{ route('cliente.index') }}"><button type="button" class="btn btn-danger">Cancelar</button></a>
               
              </div>
        </form>

        </div>
    </div>
@endsection