<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            ['name' => 'Programming'],
            ['name' =>'Database'],
            ['name' =>'Desining'],
            ['name' =>'Artist'],
            ['name' =>'Developer']
        ];
        DB::table('tags')->insert($tags);
    }
}
