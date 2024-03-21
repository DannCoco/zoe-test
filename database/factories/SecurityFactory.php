<?php

namespace Database\Factories;

use App\Models\Security;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Security>
 */
class SecurityFactory extends Factory
{
    protected $model = Security::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "security_type_id" => 1,
            "symbol" => "ASSA",
            "created_at" => now(),
            "updated_at" => now()
        ];
    }
}
