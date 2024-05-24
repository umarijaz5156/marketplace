<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = [
            ['name' => 'Programming'],
            ['name' =>'Database'],
            ['name' =>'Desining'],
            ['name' =>'Artist'],
            ['name' =>'Developer']

        ];

        DB::table('skills')->insert($skills);
    }
}
