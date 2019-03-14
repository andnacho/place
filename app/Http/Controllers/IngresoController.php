<?php

namespace App\Http\Controllers;

use Response;
use App\Ingreso;
use App\Persona;
use App\Articulo;

use Carbon\Carbon;
use App\DetalleIngreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\IngresoFormRequest;

class IngresoController extends Controller
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
           $ingresos=Ingreso::join('personas as p', "ingresos.idproveedor", '=', 'p.id')
           ->join('detalle_ingresos as di', 'ingresos.id', '=', 'di.idingreso')
           ->select('ingresos.id',
            'ingresos.fecha_hora', 
            'p.nombre',
            'ingresos.tipo_comprobante',
            'ingresos.serie_comprobante',
            'ingresos.num_comprobante', 
            'ingresos.impuesto','ingresos.estado',
             DB::raw("sum(di.cantidad*precio_compra) as total"))
             ->where('ingresos.num_comprobante', 'LIKE', '%'.$searchText.'%')
             ->orwhere('ingresos.estado', '=', 'A')
             ->orderBy('ingresos.id', 'desc')
              ->groupBy('ingresos.id',
             'ingresos.fecha_hora',
             'p.nombre',
             'ingresos.tipo_comprobante',
             'ingresos.serie_comprobante',
             'ingresos.num_comprobante', 
             'ingresos.impuesto','ingresos.estado')
             ->paginate(7);
       
           return view('compras.ingreso.index', compact( 'ingresos', 'searchText'));
            
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $personas = Persona::where('tipo_persona', '=', 'Proveedor')->get();
        $articulos = Articulo::raw('CONCAT(artitulos.codigo, " ", articulos.nombre)')
        ->where('articulos.estado', '=', '1')
        ->get();
        
        return view('compras.ingreso.create', compact('personas', 'articulos'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IngresoFormRequest $request)
    {
        //

        
        try{
         //Begin, commit y rollback() fueron creados en el modelo para no importar la clase DB
            Ingreso::beginTransaction();
            $ingreso = new Ingreso;
            $ingreso->idproveedor = $request->get('idproveedor');
            $ingreso->tipo_comprobante = $request->get('tipo_comprobante');
            $ingreso->serie_comprobante = $request->get('serie_comprobante');
            $ingreso->num_comprobante = $request->get('num_comprobante');
            
            $mytime = Carbon::now('America/Bogota');
            $ingreso->fecha_hora = $mytime->toDateTimeString();
            $ingreso->impuesto = '18';
            $ingreso->estado = 'A';
                        
            $ingreso->save();
            
            
            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio_compra = $request->get('precio_compra');
            $precio_venta = $request->get('precio_venta');
            
            $cont = 0;
            
            
            while ($cont < count($idarticulo)) {
                //Se ingresa el detalle de la compra

                $detalle = new DetalleIngreso();
                $detalle->idingreso = $ingreso->id;
                $detalle->idarticulo = $idarticulo[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->precio_compra = $precio_compra[$cont];
                $detalle->precio_venta = $precio_venta[$cont];
                
                $detalle->save();
                $cont = $cont+1;

            }
          
            Ingreso::commit();
            
        }catch(\Exception $e){
            Ingreso::rollback();
           
        }
      
        
        return redirect('compras/ingreso');

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
        $ingresos=Ingreso::join('personas as p', "ingresos.idproveedor", '=', 'p.id')
        ->join('detalle_ingresos as di', 'ingresos.id', '=', 'di.idingreso')
        ->select('ingresos.id',
         'ingresos.fecha_hora', 
         'p.nombre',
         'ingresos.tipo_comprobante',
         'ingresos.serie_comprobante',
         'ingresos.num_comprobante', 
         'ingresos.impuesto','ingresos.estado',
          DB::raw("sum(di.cantidad*precio_compra) as total"))
          ->where('ingresos.id', '=', $id)
          ->groupBy('ingresos.id',
          'ingresos.fecha_hora',
          'p.nombre',
          'ingresos.tipo_comprobante',
          'ingresos.serie_comprobante',
          'ingresos.num_comprobante', 
          'ingresos.impuesto','ingresos.estado')
          ->first();

        $detalles = DetalleIngreso::join('articulos as a', 'detalle_ingresos.idarticulo', '=', 'a.id')
        ->select('a.nombre as articulo', 'detalle_ingresos.cantidad', 'detalle_ingresos.precio_compra', 'detalle_ingresos.precio_venta')
        ->where('detalle_ingresos.idingreso', '=', $id)
        ->get();

        return view('compras.ingreso.show', compact("ingresos", "detalles"));
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
        $ingreso = Ingreso::findOrFail($id);
        $ingreso->Estado = 'c';
        $persona->update(); 
        
        return redirect('compras/ingreso');

    }
}
