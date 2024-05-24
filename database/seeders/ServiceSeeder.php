<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            ['name' => 'Proofreading'],
            ['name' => 'Fast Delivery'],
            ['name' => 'Additional Revisions'],
            ['name' => 'Document Formating'],
            ['name' => 'Styling'],
        ];

        DB::table('gig_services')->insert($services);
    }
}
