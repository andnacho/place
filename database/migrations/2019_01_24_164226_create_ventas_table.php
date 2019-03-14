<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idcliente');
            $table->integer('idusuario');
            $table->char('tipo_comprobante', 20);
            $table->char('serie_comprobante', 7);
            $table->char('num_comprobante', 20);
            $table->date('fecha_hora');
            $table->decimal('impuesto', 4, 2);
            $table->decimal('total_venta', 11, 2);
            $table->char('estado', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
