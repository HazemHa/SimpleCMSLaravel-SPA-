<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Role::class, 5)->create();

        factory(App\Category::class, 5)->create();
        factory(App\Status::class, 5)->create();
        factory(App\Gallery::class, 5)->create();
        factory(App\Settings::class, 5)->create();

        factory(App\NavigationGroups::class, 5)->create();

        factory(App\Navigations::class, 5)->create();
        factory(App\Users::class, 5)->create();
        factory(App\Posts::class, 5)->create();
        factory(App\Comments::class, 5)->create();

    }
}
