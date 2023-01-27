<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// 1
        DB::table('event_category')->insert([
            'name' => 'Automobiliai',
            'slug' => Str::slug('Automobiliai'),
        ]);

        // 2
        DB::table('event_category')->insert([
            'name' => 'Mokymai',
            'slug' => Str::slug('Mokymai'),
        ]);

        // 3
        DB::table('event_category')->insert([
            'name' => 'Parodos',
            'slug' => Str::slug('Parodos'),
        ]);

        // 4
        DB::table('event_category')->insert([
            'name' => 'Vaikams, šeimai',
            'slug' => Str::slug('Vaikams, šeimai'),
        ]);

        // 5
        DB::table('event_category')->insert([
            'name' => 'Koncertai',
            'slug' => Str::slug('Koncertai'),
        ]);

        // 6
        DB::table('event_category')->insert([
            'name' => 'Seminarai',
            'slug' => Str::slug('Seminarai'),
        ]);

        // 7
        DB::table('event_category')->insert([
            'name' => 'Spektakliai',
            'slug' => Str::slug('Spektakliai'),
        ]);

        // 8
        DB::table('event_category')->insert([
            'name' => 'Sportas',
            'slug' => Str::slug('Sportas'),
        ]);

        // 9
        DB::table('event_category')->insert([
            'name' => 'Iniciatyvos',
            'slug' => Str::slug('Iniciatyvos'),
        ]);

        // 10
        DB::table('event_category')->insert([
            'name' => 'Premjeros',
            'slug' => Str::slug('Premjeros'),
        ]);

        // 11
        DB::table('event_category')->insert([
            'name' => 'Festivaliai',
            'slug' => Str::slug('Festivaliai'),
        ]); 
        
        // 12
        DB::table('event_category')->insert([
            'name' => 'Vakarėliai',
            'slug' => Str::slug('Vakarėliai'),
        ]);
        
        // 13
        DB::table('event_category')->insert([
            'name' => 'Nemokami',
            'slug' => Str::slug('Nemokami'),
        ]); 
        
        // 14
        DB::table('event_category')->insert([
            'name' => 'Ekskursijos',
            'slug' => Str::slug('Ekskursijos'),
        ]);
        
        // 15
        DB::table('event_category')->insert([
            'name' => 'Kiti',
            'slug' => Str::slug('Kiti'),
        ]); 

        // 16
        DB::table('event_category')->insert([
            'name' => 'Mada, grožis',
            'slug' => Str::slug('Mada, grožis'),
        ]);
    }
}
