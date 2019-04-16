<?php

use Faker\Generator as Faker;

$factory->define(App\Log::class, function (Faker $faker) {
    return [
        'logable_id' => $faker->numberBetween(1, 2),
        'logable_type' => $faker->randomElement(['users', 'admins']),
        'description' => $faker->sentence,
        'created_at' => $faker->date . ' ' . $faker->time,
    ];
});
