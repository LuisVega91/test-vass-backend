<?php

use Illuminate\Database\Seeder;

class DetalleProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\DetalleProducto::class,10)->create();
    }
}
