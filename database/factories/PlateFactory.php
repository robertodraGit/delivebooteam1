<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Plate;
use Faker\Generator as Faker;

$factory->define(Plate::class, function (Faker $faker) {
    return [
      'plate_name' => $faker->word,
      'ingredients' => $faker->words,
      'description' => $faker->words,
      'price' => rand(100,3000),
      'visible' => rand(0,1),
      'discount' => rand(0,100),
      'availability' => rand(0,1),
      // 'img'
    ];
});
