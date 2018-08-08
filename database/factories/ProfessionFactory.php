<?php

use Faker\Generator as Faker;

$factory->define(App\Profession::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3, false),
        'description' => $faker->sentence(50, false)
    ];
});
