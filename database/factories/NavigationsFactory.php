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

$factory->define(App\Navigations::class, function (Faker $faker) {
    return [
        'link_text' => $faker->url,
        'url' => $faker->url,
        'description' => $faker->realText($maxNbChars = 200),
        'group_id' => function () {
            return App\NavigationGroups::inRandomOrder()->first()->id;
        },
        'click_count' => 0
    ];
});
