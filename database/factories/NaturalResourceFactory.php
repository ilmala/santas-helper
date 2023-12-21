<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ResourceType;
use App\Models\NaturalResource;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NaturalResource>
 */
class NaturalResourceFactory extends Factory
{
    protected $model = NaturalResource::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(ResourceType::cases()),
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->sentences(5, true),
            'action_point' => $this->faker->numberBetween(1, 40),
            'experience_point' => $this->faker->numberBetween(10, 100),
            'damage_point' => $this->faker->numberBetween(1, 20),
        ];
    }
}
