<?php

namespace Database\Factories\Seller;

use App\Models\Seller\Seller;
use App\Models\Seller\SellerStat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seller>
 */
class SellerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'seller_name'=> $this->faker->unique()->userName(),
            'is_approved' => true,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Seller $seller){        
            $stats = SellerStat::factory()->for($seller)->create();            
        });
    }
}
