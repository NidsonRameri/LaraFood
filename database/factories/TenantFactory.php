<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Plan;
use App\Models\Tenant;
use Faker\Generator as Faker;

$factory->define(Tenant::class, function (Faker $faker) {
    return [
        'plan_id' => factory(Plan::class), //cria um plano e relaciona [auto]
        'cnpj' => uniqid() . date('YmdHis'), //unico id conc com data, ano mes dia hora mins seg
        'name' => $faker->unique()->name,
        'email' => $faker->unique()->safeEmail,
    ];
});
