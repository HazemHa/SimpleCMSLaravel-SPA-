<?php
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Users::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'role_id' =>  function () {
            return App\Role::inRandomOrder()->first()->id;

        },
        'about' => $faker->realText($maxNbChars = 100),
        'password' => bcrypt("123123"), //
    ];
});
