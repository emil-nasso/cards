<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Attachment;
use Faker\Generator as Faker;
use App\Post;

$factory->define(Attachment::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence(5, true),
        'label' => $faker->word,
        'url' => $faker->url,
        'post_id' => Post::inRandomOrder()->first()->id,
    ];
});
