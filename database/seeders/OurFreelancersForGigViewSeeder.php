<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class OurFreelancersForGigViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('our_freelancers_for_gig_views')->truncate();
        Schema::enableForeignKeyConstraints();

        $basics = [
            [
                'seller_rating' => 1,
                'seller_orders' => 1,
                'seller_reg_date' => Carbon::now(),
                'limit' => 4,
                'status' => 1,
                'created_at' => Carbon::now()
            ]
        ];

        DB::table('our_freelancers_for_gig_views')->insert($basics);
    }
}
