<?php

use Faker\Generator as Faker;

$factory->define(App\Item::class, function (Faker $faker) {
    return [
        'category_id' => App\Category::inRandomOrder()->first()->id,
        'name' => $faker->sentence,
        'qty' => $faker->randomDigit,
        'price' => $faker->randomNumber,
        'description' => $faker->paragraph,
    ];
});
