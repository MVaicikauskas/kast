<?php

use Illuminate\Database\Seeder;

class AdsListUpdate2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('ads')->insert([
		    [ 'title' => 'BOTTOM_FIXED', 'status' => 1, 'type' => 'custom', 'custom' => 'Bottom fixed mobile' ],
	    ]);
    }
}
