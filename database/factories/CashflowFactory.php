<?php

use Faker\Generator as Faker;

$factory->define(App\Cashflow::class, function (Faker $faker) {
    return [
        'user_id' => App\User::inRandomOrder()->first()->id,
        'value' => $faker->randomNumber,
        'description' => $faker->sentence,
        'created_at' => $faker->date . ' ' . $faker->time,
    ];
});
