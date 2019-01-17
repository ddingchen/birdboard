<?php

use Faker\Generator as Faker;
use App\Project as Model;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
    ];
});
