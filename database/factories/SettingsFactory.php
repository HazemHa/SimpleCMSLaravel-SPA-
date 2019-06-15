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

$factory->define(App\Settings::class, function (Faker $faker) {
    return [
        'site_name' => $faker->name,
        'site_email' => $faker->unique()->safeEmail,
        'site_location' => $faker->realText($maxNbChars = 100),
        'site_aboutUs' => $faker->realText($maxNbChars = 100)
    ];
});
