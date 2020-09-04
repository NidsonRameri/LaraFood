<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Plan;
use Faker\Generator as Faker;

$factory->define(Plan::class, function (Faker $faker) {
    return [
        //não precisa url por causa do observer [model Plan]
        'name' => $faker->unique()->name, //name or word
        'price' => 89.9,
        'description' => $faker->sentence,
    ];
});
