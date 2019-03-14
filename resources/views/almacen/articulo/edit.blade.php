@extends('layouts.admin')

@section('contenido')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <h3>Editar Articulo: {{ $articulo->nombre }}</h3>
        @if($articulo->imagen != "")
        <img src={{ asset('/imagenes/articulos/' . $articulo->imagen) }} style="width:30%">
        @endif
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

        <form action="{{ route('articulo.update', $articulo->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $articulo->nombre }}">
              
            </div>

            <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <label for="descripcion">Descripción</label>
              <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ $articulo->descripcion }}">
              
            </div>

                  
            <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <label for="categoria">Categoría</label>
              <select class="form-control" name="idcategoria" id="categoria">
               <option value="{{ $catarticulo->id }}">{{ $catarticulo->nombre }}</option>
                @foreach ($categorias as $categoria)
              <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <label for="codigo">Codigo</label>
              <input type="text"
                class="form-control" name="codigo" id="codigo" value="{{ $articulo->codigo }}" aria-describedby="helpId">
           
            </div>

            <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <label for="stock">Stock</label>
              <input type="text"
                class="form-control" name="stock" id="stock"  value="{{ $articulo->stock }}" aria-describedby="helpId">
             </div>
             
             <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <label for="estado">Estado</label>
                    <select class="form-control" name="estado" id="estado">
                     <option value="1">Activo</option>
                     
                    <option value="0">Inactivo</option>
                     
                    </select>
                  </div>

                  <div class="form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
                      <label for="imagen">Codigo de barras</label>
                      <div>{!! DNS1D::getBarcodeSVG($articulo->codigo, "C39") !!}</div>
                    </div>

             <div class="form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
               <label for="imagen">Cambiar imagen</label>
               <input type="file" class="form-control-file" name="imagen" id="imagen">
             </div>


             <div class="container col-lg-12 col-sm-12 col-md-12 col-xs-12">
                 
                 <button type="submit" class="btn btn-primary">Actualizar articulo</button>
                 <a class="btn btn-danger" href={{ route('articulo.index') }}>Cancelar</a>
                 
                </div>

        </form>
               

        </div>

        </div>
    </div>
@endsection