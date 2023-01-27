<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(app\Models\Events\Event::class, function (Faker $faker) {

	$title = $faker->sentence(7);

    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'category_id' => $faker->numberBetween(1, 16),
        'excerpt' => $faker->realText(170),
        'description' => $faker->text,
        'date' => '2018-' . $faker->date('m-d'),
        'start_time' => $faker->time('H:i'),
        'end_time' => $faker->time('H:i'),
        'location' => $faker->address,
        'confirmed' => $faker->numberBetween(0, 1),
        'region_id' => $faker->numberBetween(1, 2),
        'is_free' => $faker->numberBetween(0, 1),
        'start_time' => '19:00',
    ];
});
