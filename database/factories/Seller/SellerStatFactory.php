<?php

namespace Database\Factories\Seller;

use App\Models\Seller\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seller\SellerStat>
 */
class SellerStatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'money_earned' => 0,
            'total_orders' => 0,
            'orders_completed' => 0,
            'orders_canceled' => 0,
            'total_reviews' => 0,
            'reviews_average' => 0,
            'response_rate' => 0
        ];
    }

  
}
