<?php

use App\Articulo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProveedoresSeeder::class,
            CategoriaSeeder::class,
            ArticulosSeeder::class        
        ]);
    }
}
