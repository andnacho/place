<?php

namespace App\Http\Controllers;

use App\Venta;
use App\Persona;
use App\Articulo;
use Carbon\Carbon;
use App\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\VentaFormRequest;


class VentaController extends Controller
{  public function __construct()
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
           $ventas=Venta::join('personas as p', "ventas.idcliente", '=', 'p.id')
           ->join('detalle_ventas as dv', 'ventas.id', '=', 'dv.idventa')
           ->select('ventas.id',
            'ventas.fecha_hora', 
            'p.nombre',
            'ventas.tipo_comprobante',
            'ventas.serie_comprobante',
            'ventas.num_comprobante', 
            'ventas.impuesto','ventas.estado',
            'ventas.total_venta')
            ->where('ventas.num_comprobante', 'LIKE', '%'.$searchText.'%')
             ->orwhere('ventas.estado', '=', 'A')
             ->orderBy('ventas.id', 'desc')
              ->groupBy('ventas.id',
             'ventas.fecha_hora',
             'p.nombre',
             'ventas.tipo_comprobante',
             'ventas.serie_comprobante',
             'ventas.num_comprobante', 
             'ventas.impuesto',
             'ventas.estado'
             )->paginate(7);

       
           return view('ventas.venta.index', compact( 'ventas', 'searchText'));
            
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $personas = Persona::where('tipo_persona', '=', 'Cliente')->get();
        $articulos = Articulo::join('detalle_ingresos as di', 'articulos.id', '=', 'di.idarticulo')
        ->select(DB::raw('CONCAT(articulos.codigo, " ", articulos.nombre) as nom'), 'articulos.id', 'articulos.stock', 
        DB::raw('avg(di.precio_venta) as promedio'))
        ->where('articulos.estado', '=', '1')
        ->where('articulos.stock', '>', '0')
        ->groupBy('articulos.id', 'articulos.stock')
        ->get();
        
      

        return view('ventas.venta.create', compact('personas', 'articulos'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VentaFormRequest $request)
    {
        //

        
        try{
         //Begin, commit y rollback() fueron creados en el modelo para no importar la clase DB
            DB::beginTransaction();
            $venta = new Venta;
            $venta->idcliente = $request->get('idcliente');
            $venta->idusuario = $request->get('idcliente');
            $venta->tipo_comprobante = $request->get('tipo_comprobante');
            $venta->serie_comprobante = $request->get('serie_comprobante');
            $venta->num_comprobante = $request->get('num_comprobante');
            $venta->total_venta = $request->get('total_venta');

            $mytime = Carbon::now('America/Bogota');
            $venta->fecha_hora = $mytime->toDateTimeString();
            $venta->impuesto = '18';
            $venta->estado = 'A';
                        
            $venta->save();
            
            
            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $descuento = $request->get('descuento');
            $precio_venta = $request->get('precio_venta');
            
            $cont = 0;
            
            
            while ($cont < count($idarticulo)) {
                //Se ingresa el detalle de la compra

                $detalle = new DetalleVenta();
                $detalle->idventa = $venta->id;
                $detalle->idarticulo = $idarticulo[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->descuento = $descuento[$cont];
                $detalle->precio_venta = $precio_venta[$cont];
                
                $detalle->save();
                $cont = $cont+1;

            }
          
            DB::commit();
            
        }catch(\Exception $e){
            DB::rollback();
           
        }
      
        
        return redirect('ventas/ventas');

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
        $venta=Venta::join('personas as p', "ventas.idcliente", '=', 'p.id')
        ->join('detalle_ventas as dv', 'ventas.id', '=', 'dv.idventa')
        ->select('ventas.id',
         'ventas.fecha_hora', 
         'p.nombre',
         'ventas.tipo_comprobante',
         'ventas.serie_comprobante',
         'ventas.num_comprobante', 
         'ventas.impuesto','ventas.estado', 'ventas.total_venta')
          ->where('ventas.id', '=', $id)
        //   ->groupBy('ventas.id',
        //   'ventas.fecha_hora',
        //   'p.nombre',
        //   'ventas.tipo_comprobante',
        //   'ventas.serie_comprobante',
        //   'ventas.num_comprobante', 
        //   'ventas.impuesto','ventas.estado')
          ->first();

        $detalles = DetalleVenta::join('articulos as a', 'detalle_ventas.idarticulo', '=', 'a.id')
        ->select('a.nombre as articulo', 'detalle_ventas.cantidad', 'detalle_ventas.descuento', 'detalle_ventas.precio_venta')
        ->where('detalle_ventas.idventa', '=', $id)
        ->get();

        return view('ventas.venta.show', compact("venta", "detalles"));
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
        $venta = Venta::findOrFail($id);
        $venta->Estado = 'C';
        $venta->update(); 
        
        return redirect('ventas/ventas');

    }
}
