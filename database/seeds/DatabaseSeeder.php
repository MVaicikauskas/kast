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
        $this->call([
            // EventCategorySeeder::class,
            // EventRegionSeeder::class,
            // PageSettingsSeeder::class,
            // PostCategorySeeder::class,
            // ActivityCategorySeeder::class,
            // ActivitySubCategorySeeder::class,
            ActivityRegionSeeder::class,
        ]);

        // Call if want to seed random events
        // factory(app\Models\Events\Event::class, 30)->create()->each(function($e) {
        // 	$e->make();
        // });
        // Call if want to seed random posts
        // factory(app\Models\Posts\Post::class, 99)->create()->each(function($e) {
        // 	$e->make();
        // });

    }
}
