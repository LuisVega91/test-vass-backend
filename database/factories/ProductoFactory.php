<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Producto;
use Faker\Generator as Faker;

$factory->define(Producto::class, function (Faker $faker) {


    $super = ['HULK', 'SPIDERMAN', 'THOR', 'IRONMAN', 'ACUAMAN', 'SUPERMAN', 'BATMAN'];
    $universo = ['MARVEL', 'MARVEL', 'MARVEL', 'MARVEL', 'DC-COMICS', 'DC-COMICS', 'DC-COMICS'];
    $color = ['ROJO', 'VERDE', 'AZUL', 'PURPURA', 'GRIS', 'AMARILLO', 'NEGRO',];
    $articulo = ['SUETER', 'VASO', 'COMIC', 'FIGURA_ACCION', 'GANCHO', 'CINTURON', 'MOVIL'];

    $id = $faker->numberBetween(0, 6);

    return [
        "articulo" => $articulo[$faker->numberBetween(0, 6)]
                      . " " . $color[$faker->numberBetween(0, 6)]
                      . " " . $super[$id] ." " . $universo[$id],
        'referencia' => 'REF'. strtoupper (uniqid()),
        'localizacion' => $faker->numerify('BODEGA ## ESTANTE ##'),
        'minimo' => $faker->numberBetween(10, 20),
        'maximo' => $faker->numberBetween(60, 99),
        'tipo_unidad' => $faker->randomDigit,
        'id_proveedor' => $faker->numberBetween(1, 10),
    ];
});
