<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ActivitySubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('activity_subcategories')->insert([
          'name' => 'Vizualieji menai',
          'slug' => Str::slug('Vizualieji menai'),
      ]);

      DB::table('activity_subcategories')->insert([
        'name' => 'Muzika',
        'slug' => Str::slug('Muzika'),
      ]); 

      DB::table('activity_subcategories')->insert([
        'name' => 'Vaidyba',
        'slug' => Str::slug('Vaidyba'),
      ]); 

      DB::table('activity_subcategories')->insert([
        'name' => 'Šokiai',
        'slug' => Str::slug('Šokiai'),
      ]); 

      DB::table('activity_subcategories')->insert([
        'name' => 'Kulinarija',
        'slug' => Str::slug('Kulinarija'),
      ]); 

      DB::table('activity_subcategories')->insert([
        'name' => 'Užsienio kalbos',
        'slug' => Str::slug('Užsienio kalbos'),
      ]); 

      DB::table('activity_subcategories')->insert([
        'name' => 'Baseinas',
        'slug' => Str::slug('Baseinas'),
      ]); 

      DB::table('activity_subcategories')->insert([
        'name' => 'Sportas',
        'slug' => Str::slug('Sportas'),
      ]); 

      DB::table('activity_subcategories')->insert([
        'name' => 'Verslumas ir kūrybiškumas',
        'slug' => Str::slug('Verslumas ir kūrybiškumas'),
      ]); 
    }
}
