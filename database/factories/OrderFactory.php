<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
      'first_name' => $faker->firstName,
      'last_name' => $faker->lastName,
      'email' => $faker->email,
      'phone' => $faker->e164PhoneNumber,
      'comment' => $faker->words,
      'address' => $faker->streetAddress,
      'payment_state' => rand(0,1),
      'total_price' => rand(100,10000),
    ];
});
