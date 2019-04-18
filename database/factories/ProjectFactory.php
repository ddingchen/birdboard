<?php

use App\Project as Model;
use App\User;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->sentence,
        'notes' => $faker->sentence,
        'owner_id' => factory(User::class),
    ];
});
