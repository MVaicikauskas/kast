<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventRegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        DB::table('event_regions')->insert([
            'name' => 'Klaipėda',
            'slug' => Str::slug('Klaipėda')
        ]);

        // 2
        DB::table('event_regions')->insert([
            'name' => 'Klaipėdos Kraštas',
            'slug' => Str::slug('Klaipėdos Kraštas')
        ]);
    }
}
