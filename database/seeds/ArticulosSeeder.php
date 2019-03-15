<?php

use App\Articulo;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;


class ArticulosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

         Articulo::truncate();

        for ($i=1; $i<11; $i++){
        Articulo::create([
            'idcategoria' => $i,
            'codigo' => '00'.$i,
            'nombre' => $faker->word,
            'descripcion' => $faker->name,
            'stock' => $faker->numberBetween(10, 20),
            'estado' => '1',
           
            
        ]);
        }
    }
}
