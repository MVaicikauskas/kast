<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdsListUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ads')->insert([
            [ 'title' => 'SIDEBAR_RE_HOME', 'status' => 1, 'type' => 'custom', 'custom' => 'Sidebar Re Home' ],
            [ 'title' => 'SIDEBAR_RE_NEWS', 'status' => 1, 'type' => 'custom', 'custom' => 'Sidebar Re News' ],
            [ 'title' => 'SIDEBAR_RE_EVENTS', 'status' => 1, 'type' => 'custom', 'custom' => 'Sidebar Re Events' ],
            [ 'title' => 'SIDEBAR_RE_ACTIVITIES', 'status' => 1, 'type' => 'custom', 'custom' => 'Sidebar Re Activities' ],
        ]);
    }
}
