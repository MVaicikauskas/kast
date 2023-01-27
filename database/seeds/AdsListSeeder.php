<?php

use Illuminate\Database\Seeder;

class AdsListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ads')->insert([
            [ 'title' => 'HEADER_RE', 'status' => 1, 'type' => 'custom', 'custom' => 'Header Re' ],
            [ 'title' => 'SIDEBAR_RE', 'status' => 1, 'type' => 'custom', 'custom' => 'Sidebar Re' ],
            [ 'title' => 'HOME_MOBILE_RE', 'status' => 1, 'type' => 'custom', 'custom' => 'Home Mobile Re' ],
            [ 'title' => 'HOME_LEADERBORD_RE', 'status' => 1, 'type' => 'custom', 'custom' => 'Home Leaderboard Re' ],
            [ 'title' => 'CATEGORY_RE', 'status' => 1, 'type' => 'custom', 'custom' => 'Vategory Re' ],
            [ 'title' => 'POST_MOBILE_RE', 'status' => 1, 'type' => 'custom', 'custom' => 'Post Mobile Re' ],
            [ 'title' => 'POST_1_RE', 'status' => 1, 'type' => 'custom', 'custom' => 'Post 1 Re' ],
            [ 'title' => 'POST_2_RE', 'status' => 1, 'type' => 'custom', 'custom' => 'Post 2 Re' ],
            [ 'title' => 'POST_3_RE', 'status' => 1, 'type' => 'custom', 'custom' => 'Post 3 Re' ],
            [ 'title' => 'FOOTER_RE', 'status' => 1, 'type' => 'custom', 'custom' => 'Footer Re' ],
        ]);
    }
}
