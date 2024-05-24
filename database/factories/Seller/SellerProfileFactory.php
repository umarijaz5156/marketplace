<?php

namespace Database\Factories\Seller;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seller\SellerProfile>
 */
class SellerProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'description' => $this->faker->text(),
            'address_line1' => $this->faker->address(),
            'country_id' => 168,
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}
