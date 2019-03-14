<?php

namespace App\Http\Controllers;

use App\Articulo;
use App\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\ArticuloFormRequest;

class ArticuloController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
           
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if(true)
        {
           $searchText=trim($request->get('searchText'));
          $articulos=Articulo::join('categorias', 'categorias.id','=', 'articulos.idcategoria')
            ->select('articulos.id', 'articulos.nombre', 'articulos.codigo', 'articulos.stock', 'categorias.nombre as categoria', 'articulos.descripcion', 'articulos.imagen', 'articulos.estado')
            ->where('articulos.nombre', 'LIKE', '%'.$searchText.'%')
            ->orwhere('articulos.codigo', 'LIKE', '%'.$searchText.'%')
           ->orderBy('id', 'desc') 
            ->paginate(7);

           
           return view('almacen.articulo.index', compact('articulos', 'searchText'));

        }

        
        

           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categorias=Categoria::all()
        ->where('condicion', '=', 1);



        return view('almacen.articulo.create', compact('categorias'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
      
        $articulo = new Articulo;
        $articulo->nombre=$request->get('nombre');
        $articulo->descripcion=$request->get('descripcion');
        $articulo->idcategoria= $request->get('idcategoria');
        $articulo->codigo= $request->get('codigo');
        $articulo->stock= $request->get('stock');
        $articulo->estado= '1';
        
        if($request->hasFile('imagen'))
        {
            $file = $request->file('imagen');
            $file->move(public_path().'/imagenes/articulos/', $file->getClientOriginalName());
            $articulo->imagen = $file->getClientOriginalName();
        }

        $articulo->save();
        return redirect('almacen/articulo');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('almacen.articulo.show', ["Articulo" => Articulo::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $articulo = Articulo::findOrFail($id);
        $categorias=Categoria::all()
        ->where('condicion', '=', 1);
        $catarticulo = Categoria::where('id' , '=', $articulo->idcategoria)->select('id', 'nombre')->first();
     
        return view('almacen.articulo.edit', compact('articulo', 'categorias', 'catarticulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticuloFormRequest $request, $id)
    {
        //
        $articulo = Articulo::findOrFail($id);
        $articulo->nombre=$request->get('nombre');
        $articulo->descripcion=$request->get('descripcion');
        $articulo->idcategoria= $request->get('idcategoria');
        $articulo->codigo= $request->get('codigo');
        $articulo->stock= $request->get('stock');
        $articulo->estado= $request->get('estado');;
        
        if($request->hasFile('imagen'))
        {
            $file = $request->file('imagen');
            $file->move(public_path().'/imagenes/articulos/', $file->getClientOriginalName());
            $articulo->imagen = $file->getClientOriginalName();
        }

        $articulo->update();

        return redirect('almacen/articulo')->with('actualizado', 'Articulo actualizado');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $articulo = Articulo::findOrFail($id);
        $articulo->estado = '0';
        $articulo->update(); 
        
        return redirect('almacen/articulo');

    }
}
