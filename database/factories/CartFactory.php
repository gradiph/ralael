<?php

use Faker\Generator as Faker;

$factory->define(App\Cart::class, function (Faker $faker) {
    return [
        'user_id' => App\User::inRandomOrder()->first()->id,
        'item_id' => $faker->unique()->randomDigitNotNull,
        'qty' => $faker->randomDigitNotNull,
        'note' => $faker->sentence,
    ];
});
