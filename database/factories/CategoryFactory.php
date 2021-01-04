<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\models\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
    'name' =>  $faker->word(),
    'slug' =>  $faker->slug(),
    'is_active' =>  $faker->boolean(),

    ];
});
