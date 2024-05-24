<?php

namespace Database\Seeders;

use App\Models\Seller\Seller;
use App\Models\Seller\SellerProfile;
use App\Models\Seller\SellerStat;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // normal user factory
        $users = User::factory(5)->create();
       
        // seller factory
        User::factory()->has(
            Seller::factory()->has(
                SellerProfile::factory()->count(1),
            )->count(1),
        )->count(3)->create(['is_seller' => 1]);

        // add stats
     
        // admin factory
        // $admin = User::factory(1)->create(['email' => 'admin@gmail.com', 'is_admin' => 1]);
        // manager factory
        $amanger = User::factory(1)->create(['email' => 'manager@gmail.com', 'is_ticket_manager' => 1]);
                    
    }
}
