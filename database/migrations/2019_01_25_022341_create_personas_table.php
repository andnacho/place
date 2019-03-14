<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->char('tipo_persona', 20);
            $table->char('nombre', 100);
            $table->char('tipo_documento', 20)->nullable();
            $table->char('num_documento',15)->nullable();
            $table->char('direccion', 70)->nullable();
            $table->char('telefono', 15)->nullable();
            $table->char('email', 70)->nullable();
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
        Schema::dropIfExists('personas');
    }
}
