<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ConfigHomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('config_home')->truncate();
        Schema::enableForeignKeyConstraints();

        $home = [
            [
                'title' => 'Find The Perfect Freelance Services for Your Business',
                'description' => 'There is now an abundance of readable dummy texts. These are usually used when a text is required purely to fill a space.',
                'header_image' => '',
                'popular_categories_filter' => 1,
                'market_place_filter' => 1,
                'seller_filter' => 1,
                'gigs_filter' => 1
            ]
        ];

        DB::table('config_home')->insert($home);
    }
}
