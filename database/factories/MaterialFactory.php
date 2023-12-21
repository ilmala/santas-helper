<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\MaterialType;
use App\Enums\ResourceType;
use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    protected $model = Material::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(MaterialType::cases()),
            'name' => $this->faker->word(),
            'cost' => $this->faker->numberBetween(1, 999),
            'weight' => $this->faker->numberBetween(10, 99),
        ];
    }
}
