<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Producto;
use Faker\Generator as Faker;

$factory->define(Producto::class, function (Faker $faker) {


    $super = ['HULK', 'SPIDERMAN', 'THOR', 'IRONMAN', 'ACUAMAN', 'SUPERMAN', 'BATMAN'];
    $universo = ['MARVEL', 'MARVEL', 'MARVEL', 'MARVEL', 'DC COMICS', 'DC COMICS', 'DC COMICS'];
    $articulo = ['SUETER', 'VASO', 'COMIC', 'FIG-ACCION', 'GANCHO', 'CINTURON', 'MOVIL'];
    $tipoUnidad = ['Unidad', 'Kilogramos', 'Docena'];

    $id = $faker->numberBetween(0, 6);

    return [
        "articulo" => $articulo[$faker->numberBetween(0, 6)]
                      . " " . $super[$id] ." " . $universo[$id],
        'referencia' => 'REF'. strtoupper (uniqid()),
        'localizacion' => $faker->numerify('BODEGA ## ESTANTE ##'),
        'minimo' => $faker->numberBetween(10, 20),
        'maximo' => $faker->numberBetween(60, 99),
        'tipo_unidad' => $tipoUnidad[$faker->numberBetween(0,2)],
        'id_proveedor' => $faker->numberBetween(1, 10),
    ];
});
