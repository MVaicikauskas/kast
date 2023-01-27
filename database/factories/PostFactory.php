<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(app\Models\Posts\Post::class, function (Faker $faker) {

	$title = $faker->sentence(7);

  return [
      'title' => $title,
      'slug' => Str::slug($title),
      'category_id' => $faker->numberBetween(1, 10),
      'excerpt' => $faker->realText(170),
      'description' => $faker->text
  ];
});
