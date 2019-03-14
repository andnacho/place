@extends('layouts.admin')

@section('contenido')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <h3>Nuevo articulo</h3>
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

        <form action="{{ route('articulo.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <label for="nombre">Nombre</label>
              <input type="text" name="nombre" id="nombre" class="form-control" placeholder="nombre">
              
            </div>

            <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <label for="descripcion">Descripción</label>
              <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="descripción del producto">
              
            </div>

            <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <label for="categoria">Categoría</label>
              <select class="form-control" name="idcategoria" id="categoria">
                @foreach ($categorias as $categoria)
              <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <label for="codigo">Codigo</label>
              <input type="text"
                class="form-control" name="codigo" id="codigo" aria-describedby="helpId">
           
            </div>

            <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <label for="stock">Stock</label>
              <input type="text"
                class="form-control" name="stock" id="stock" aria-describedby="helpId">
             </div>

             <div class="form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
               <label for="imagen">Imagen</label>
               <input type="file" class="form-control-file" name="imagen" id="imagen">
              
             </div>
             <div class="container col-lg-12 col-sm-12 col-md-12 col-xs-12">
               
               <button type="submit" class="btn btn-primary ">Ingresar nuevo articulo</button>
               <a href=" {{ route('articulo.index') }}"><button type="button" class="btn btn-danger">Cancelar</button></a>
               
              </div>
        </form>

        </div>
    </div>
@endsection