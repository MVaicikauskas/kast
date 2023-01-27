<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('post_categories')->insert([
          'name' => 'Klaipėda',
          'slug' => Str::slug('Klaipėda'),
      ]);
      DB::table('post_categories')->insert([
          'name' => 'Rajonas',
          'slug' => Str::slug('Rajonas'),
      ]);
      DB::table('post_categories')->insert([
          'name' => 'Kultūra',
          'slug' => Str::slug('Kultūra'),
      ]);
      DB::table('post_categories')->insert([
          'name' => 'Sportas',
          'slug' => Str::slug('Sportas'),
      ]);
      DB::table('post_categories')->insert([
          'name' => 'Laisvalaikis',
          'slug' => Str::slug('Laisvalaikis'),
      ]);
      DB::table('post_categories')->insert([
          'name' => 'Eismas',
          'slug' => Str::slug('Eismas'),
      ]);
      DB::table('post_categories')->insert([
          'name' => 'Verslas',
          'slug' => Str::slug('Verslas'),
      ]);
      DB::table('post_categories')->insert([
          'name' => 'Nuomonės',
          'slug' => Str::slug('Nuomonės'),
      ]);
      DB::table('post_categories')->insert([
          'name' => 'Sveikata',
          'slug' => Str::slug('Sveikata'),
      ]);
      DB::table('post_categories')->insert([
          'name' => 'Talentai',
          'slug' => Str::slug('Talentai'),
      ]);
    }
}
