<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ActivityCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// 1
      DB::table('activity_categories')->insert([
          'name' => 'Vaikams',
          'slug' => Str::slug('Vaikams'),
      ]);

      // 2
      DB::table('activity_categories')->insert([
          'name' => 'Suaugusiems',
          'slug' => Str::slug('Suaugusiems'),
      ]);
    }
}
