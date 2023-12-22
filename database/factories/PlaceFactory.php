<?php

namespace Database\Factories;

use App\Enums\PlaceType;
use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    protected $model = Place::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(PlaceType::cases()),
            'name' => $this->faker->sentence(),
            'description' => $this->faker->sentences(6, true),
        ];
    }
}
