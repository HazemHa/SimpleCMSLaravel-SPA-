<?php
use Illuminate\Support\Str;
use Faker\Generator as Faker;
/*
|
--------------------------------------------------------------------------
| Model Factories
|
-------------------------------------------------------------------------
|
| This directory should contain each of the model
factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your
application's database.
|
*/

$factory->define(App\Posts::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return App\Users::inRandomOrder()->first()->id;
        },
        'title' => $faker->title,
        'content' =>$faker->realText($maxNbChars = 100),
        'category_id' => function () {
            return App\Category::inRandomOrder()->first()->id;

        },
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'status_id' => function () {
            return App\Status::inRandomOrder()->first()->id;

        }
    ];
});
