<?php

use Faker\Generator as Faker;

$factory->define(App\Payment::class, function (Faker $faker) {
    return [
        'transaction_id' => App\Transaction::inRandomOrder()->first()->id,
        'value' => $faker->randomNumber,
        'address' => 'sample-' . mt_rand(1, 3) . '.jpg',
        'created_at' => $faker->date . ' ' . $faker->time,
        'verified_at' => $faker->randomElement([$faker->date . ' ' . $faker->time, NULL]),
    ];
});
