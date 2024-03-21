<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SecurityPrice>
 */
class SecurityPriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "security_id" => 1,
            "last_price" => 12.34,
            "as_of_date" => now(),
            "created_at" => now(),
            "updated_at" => now()
        ];
    }
}
