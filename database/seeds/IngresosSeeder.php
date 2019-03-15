<?php

use App\Ingreso;
use Carbon\Carbon;
use App\DetalleIngreso;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class IngresosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Ingreso::truncate();
        DetalleIngreso::truncate();

        for ($i=1; $i<11; $i++){
        Ingreso::create([
            'idproveedor' => 1,
            'tipo_comprobante' => strtotime(Carbon::now()->addSeconds($i)),
            'serie_comprobante' => strtotime(Carbon::now()->addSeconds($i)),
            'num_comprobante' => 0,
            'fecha_hora' => Carbon::now()->addSeconds($i),
            'impuesto' => 20,
            'estado' => 'B',            
           
        ]);
        DetalleIngreso::create([
            'idingreso' => $i,
            'idarticulo' => $i,
            'cantidad' => $faker->numberBetween(10, 20),
            'precio_compra' => $faker->numberBetween(1000, 2000),
            'precio_venta' => $faker->numberBetween(2001, 4000),

        ]);
    }
}
}
