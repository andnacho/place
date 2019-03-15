<?php

use App\Categoria;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

         Categoria::truncate();

        for ($i=1; $i<11; $i++){
        Categoria::create([
            'nombre' => $faker->name,
            'descripcion' => $faker->name,
            'condicion' => 1,
            
        ]);
        }
    }
}
