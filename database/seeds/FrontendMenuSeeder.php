<?php

use Illuminate\Database\Seeder;

class FrontendMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('frontend_menus')->truncate();
        $rows = [
            [
                'link_name' => 'Home',
                'link_url' => '/'
            ],
            [
                'link_name' => 'Contact',
                'link_url' => '/contact'
            ],
            [
                'link_name' => 'News',
                'link_url' => '/view/news'
            ],
            [
                'link_name' => 'Notice',
                'link_url' => '/view/notice'
            ],
            [
                'link_name' => 'Downloads',
                'link_url' => '/view/downloads'
            ],
            [
                'link_name' => 'Events',
                'link_url' => '/view/events'
            ],

        ];
        DB::table('frontend_menus')->insert($rows);
    }
}
