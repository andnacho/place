<?php

namespace App\Http\Controllers;

use App\Persona;
use Illuminate\Http\Request;
use App\Http\Requests\PersonaFormRequest;

class ClienteController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
           
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
           $searchText=trim($request->get('searchText'));
           $clientes=Persona::where('tipo_persona', "=", 'Cliente')
           ->where('nombre', 'LIKE', '%'.$searchText.'%')
           ->orwhere('tipo_persona', "=", 'Cliente')
           ->where('num_documento', 'LIKE', '%'.$searchText.'%')
           ->orderBy('id', 'desc') 
           ->orderBy('num_documento', 'desc') 
            ->paginate(7);
             
           
           return view('ventas.cliente.index', compact('clientes', 'searchText'));
    
           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('ventas.cliente.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonaFormRequest $request)
    {
        //
      
        $persona = new Persona;
        $persona->tipo_persona='Cliente';
        $persona->nombre=$request->get('nombre');
        $persona->tipo_documento = $request->get('tipo_documento');
        $persona->num_documento = $request->get('num_documento');
        $persona->direccion=$request->get('direccion');
        $persona->telefono = $request->get('telefono');
        $persona->email = $request->get('email');
        $persona->save();

        return redirect('ventas/cliente');

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
        return view('ventas.cliente.show', ["cliente" => Persona::findOrFail($id)]);
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
        return view('ventas.cliente.edit', ["cliente" => Persona::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonaFormRequest $request, $id)
    {
        //

       
        $persona = Persona::findOrFail($id);
        $persona->nombre=$request->get('nombre');
        $persona->tipo_documento = $request->get('tipo_documento');
        $persona->num_documento = $request->get('num_documento');
        $persona->direccion=$request->get('direccion');
        $persona->telefono = $request->get('telefono');
        $persona->email = $request->get('email');
        $persona->update();


        return redirect('ventas/cliente');


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
        $persona = Persona::findOrFail($id);
        $persona->tipo_persona = 'Inactivo';
        $persona->update(); 
        
        return redirect('ventas/cliente');

    }
}
