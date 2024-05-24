<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MiscConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('misc_configs')->truncate();
        Schema::enableForeignKeyConstraints();

        $basics = [
            [
                'name' => 'order_complete',
                'value' => '3'
            ],
            [
                'name' => 'revisions',
                'value' => '3'
            ],
            [
                'name' => 'spam_keywords',
                'value' => json_encode(['whatsapp', 'email', 'telegram'])
            ]
        ];

        DB::table('misc_configs')->insert($basics);
    }
}
