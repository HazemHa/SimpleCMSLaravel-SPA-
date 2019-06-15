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

$factory->define(App\Comments::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return App\Users::inRandomOrder()->first()->id;

        },
        'post_id' =>  function () {
            return App\Posts::inRandomOrder()->first()->id;

        },
        'name' => $faker->name,
        'email' => $faker->email,
        'subject' => $faker->realText($maxNbChars = 200, $indexSize = 1),
        'message' => $faker->realText($maxNbChars = 200, $indexSize = 1)
    ];
});
