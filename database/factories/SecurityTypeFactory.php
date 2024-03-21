<?php

namespace Database\Factories;

use App\Models\SecurityType;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SecurityType>
 */
class SecurityTypeFactory extends Factory
{
    protected $model = SecurityType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "slug" => $this->faker->slug(),
            "name" => $this->faker->name(),
            "created_at" => now(),
            "updated_at" => now()
        ];
    }
}
