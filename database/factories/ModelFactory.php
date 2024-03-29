<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'isadmin' => $faker->numberBetween($min = 0, $max = 1),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Article::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->title,
        'content' => $faker->paragraph,
        'picture' => $faker->imageUrl,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Comment::class, function (Faker\Generator $faker) {

    return [
        'content' => $faker->sentence,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'article_id' => function () {
            return factory(App\Article::class)->create()->id;
        }

    ];
});