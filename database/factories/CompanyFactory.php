<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'activity' => $faker->sentence(1, false),
        'address' => 'Cl. 48b #77B-22, Medellín, Antioquia, Colombia',
        'image' => 'http://www.soolet.net/wp-content/uploads/2013/10/facebook1_1.jpg',
        'seo' => $faker->name
    ];
});
