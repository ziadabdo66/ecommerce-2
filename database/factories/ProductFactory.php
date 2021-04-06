<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\models\Category;

$factory->define(\App\models\Product::class, function (Faker $faker) {
    return [
        'name' =>  $faker->word(),
        'description' =>  $faker->paragraph(),
        'short_description' =>  $faker->paragraph(),
        'slug' =>  $faker->slug(),
        'price'=>$faker->numberBetween(10,9000),
        'manage_stock'=>false,
        'in_stock'=>$faker->boolean(),
        'sku' =>  $faker->word(),
        'is_active' =>  $faker->boolean(),

    ];
});
