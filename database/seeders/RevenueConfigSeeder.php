<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RevenueConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('revenue_configurations')->truncate();
        Schema::enableForeignKeyConstraints();

        $basics = [
            [
                'revenue_commision' => 20,
                'refund_commission' => 10,
                'created_at' => Carbon::now()
            ]
        ];

        DB::table('revenue_configurations')->insert($basics);
    }
}
