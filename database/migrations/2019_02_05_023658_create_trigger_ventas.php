<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerVentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER tr_update_stock_ventas AFTER INSERT ON `detalle_ventas` FOR EACH ROW
        BEGIN
        UPDATE articulos SET stock = stock - NEW.cantidad
        Where articulos.id = NEW.idarticulo;
        END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `tr_update_stock_ventas`');
    }
}
