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

function slagName($string){
    $template = "";
    $result = preg_replace('/\s+/', '-',$string);
    foreach($result as $value) {
        $template .= $value;
    }
    return $template;
}

$factory->define(App\NavigationGroups::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement($array = array ('admin','user','guest')),
        'slug' => slagName([$faker->randomElement($array = array ('admin','user','guest'))])
    ];
});
