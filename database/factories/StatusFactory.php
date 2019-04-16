<?php

use Faker\Generator as Faker;

$factory->define(App\Status::class, function (Faker $faker) {
    return [
        'order' => $faker->unique()->randomDigit,
        'name' => $faker->unique()->sentence,
    ];
});
