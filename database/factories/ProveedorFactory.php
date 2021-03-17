<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

$factory->define(\App\Proveedore::class, function (Faker $faker) {
    return [
        'nombre' =>$faker->name
    ];
});
