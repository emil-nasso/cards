<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'slug' => $faker->word(),
        'menu_label' => $faker->word(),
        'body' => $faker->text(200),
        'category_id' => Category::inRandomOrder()->first()->id,
        'order' => $faker->randomNumber(4),
        'published' => $faker->boolean(),
        'created_at' => $faker->dateTime()
    ];
});
