<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'body' => $faker->text(2000),
        'order' => $faker->randomNumber(4),
        'published' => $faker->boolean(),
        'created_at' => $faker->dateTime()
    ];
});
