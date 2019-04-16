<?php

use Faker\Generator as Faker;

$factory->define(App\Image::class, function (Faker $faker) {
    return [
        'item_id' => App\Item::inRandomOrder()->first()->id,
        'order' => $faker->randomDigit,
        'title' => $faker->sentence,
        'address' => 'sample-' . mt_rand(1, 3) . '.jpg',
    ];
});
