<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Kind;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kind' => Kind::Elf->value,
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'health' => Kind::Elf->healthMax(),
            'max_health' => Kind::Elf->healthMax(),
            'crystal' => Kind::Elf->crystalMax(),
            'max_crystal' => Kind::Elf->crystalMax(),
            'action' => Kind::Elf->actionMax(),
            'max_action' => Kind::Elf->actionMax(),
            'weight' => 0,
            'max_weight' => 60,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
