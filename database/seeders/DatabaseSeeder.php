<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ConfigHomeSeeder::class,
            ConfigBasicSeeder::class,
            CountrySeeder::class,
            SkillSeeder::class,
            TagSeeder::class,
            ServiceSeeder::class,
            GigViewPageRcmndedGigsSeeder::class,
            AlsoViewedSeeder::class,
            OurFreelancersForGigViewSeeder::class,
            OurFreelancersForHomeSeeder::class,
            PopularServicesHomeSeeder::class,
            RevenueConfigSeeder::class,
            AffiliateConfigSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            GigSeeder::class,
            MiscConfigSeeder::class,

        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
