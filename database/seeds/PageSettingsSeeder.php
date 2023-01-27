<?php

use Illuminate\Database\Seeder;

class PageSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        DB::table('page_settings')->insert([
            'title' => 'Klaipėda, aš su tavim!',
            'description' => 'Čia mūsų miestas',
        ]);
    }
}
