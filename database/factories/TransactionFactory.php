<?php

use Faker\Generator as Faker;

$factory->define(App\Transaction::class, function (Faker $faker) {
    $user = App\User::inRandomOrder()->first();

    return [
        'user_id' => $user->id,
        'recipient_id' => $user->recipients()->inRandomOrder()->first()->id,
    ];
});
