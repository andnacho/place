<?php

use App\Persona;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class ProveedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        
       

        Persona::truncate();

        
        Persona::create([  
          'tipo_persona'=> 'Proveedor',
          'nombre'=> $faker->firstName        
            ]);
        
            Persona::create([  
                'tipo_persona'=> 'Proveedor',
                'nombre'=> $faker->name        
                  ]);
                  
                  Persona::create([  
                    'tipo_persona'=> 'Proveedor',
                    'nombre'=> $faker->name        
                      ]);

    }
}
