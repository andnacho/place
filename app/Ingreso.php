<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    //
    protected $fillable = [
        'idproveedor',
        'tipo_comprobante',
        'serie_comprobante',
        'num_comprobante',
        'impuesto',
        'estado '
    ];

    public static function beginTransaction()
     {
          self::getConnectionResolver()->connection()->beginTransaction();
     }

     public static function commit()
     {
         self::getConnectionResolver()->connection()->commit();
     }

     public static function rollBack()
     {
         self::getConnectionResolver()->connection()->rollBack();
     }    

     public function estado($estado){
            if($estado == 'A')
             return 'Aprobado';
                        
             elseif($estado == 'R')
             return "Rechazado";

             elseif($estado == 'P')
             return "Pendiente";

             else return 'Sin procesar';
     }
}
