<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ConfigBasicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('config_basics')->truncate();
        Schema::enableForeignKeyConstraints();

        $basics = [
            [
                'site_title' => 'thehotbleep',
                'logo_image' => '',
                'fav_icon' => ''
            ]
        ];

        DB::table('config_basics')->insert($basics);
    }
}
