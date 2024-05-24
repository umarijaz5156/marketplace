<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AffiliateConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('affiliate_configs')->truncate();


        $basics = [
            [
                'site_title' => 'TheHotBleep',
                'logo_image' => '',
                'fav_icon' => ''
            ]
        ];

        DB::table('affiliate_configs')->insert(
            [
                'title' => 'commission',
                'value' => 10
            ]
        );
    }
}
