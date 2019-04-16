<?php

use Faker\Generator as Faker;

$factory->define(App\Recipient::class, function (Faker $faker) {
    return [
        'user_id' => App\User::inRandomOrder()->first()->id,
        'name' => $faker->name,
        'address' => $faker->address,
        'urban' => $faker->word,
        'subdistrict' => $faker->word,
        'city' => $faker->city,
        'province' => $faker->state,
        'post_code' => $faker->postcode,
    ];
});
