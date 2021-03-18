<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DetalleProducto;
use Faker\Generator as Faker;

$factory->define(DetalleProducto::class, function (Faker $faker) {

    return [
        'descripcion' =>  $faker->sentence,
        'valor_unitario' => $faker->numberBetween(10, 20),
        'entrada_cantidad' => $faker->numberBetween(10, 20),
        'entrada_valor' =>  $faker->numberBetween(10, 20),
        'salida_cantidad' => 0,
        'salida_valor' => 0,
        'saldo_cantidad' => $faker->numberBetween(40, 80),
        'saldo_valor' => $faker->numberBetween(200, 500),
        'id_producto' =>  $faker->numberBetween(1, 10),
    ];
});
