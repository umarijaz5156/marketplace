<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GigViewPageRcmndedGigsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('gig_view_page_rcmnded_gigs')->truncate();
        Schema::enableForeignKeyConstraints();

        $basics = [
            [
                'seller_rating' => 1,
                'gig_rating' => 1,
                'gig_orders' => 1,
                'seller_orders' => 1,
                'seller_reg_date' => Carbon::now(),
                'gig_add_date' => Carbon::now(),
                'gigs_limit' => 4,
                'status' => 1,
                'created_at' => Carbon::now()
            ]
        ];

        DB::table('gig_view_page_rcmnded_gigs')->insert($basics);
    }
}
