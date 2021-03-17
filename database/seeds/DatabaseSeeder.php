<?php

use App\DetalleProducto;
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
            UserSeeder::class,
            ProveedorSeeder::class,
            ProductoSeeder::class,
            DetalleProductoSeeder::class,
        ]);
    }
}
