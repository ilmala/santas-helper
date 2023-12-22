<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\Direction;
use App\Enums\Kind;
use App\Enums\MaterialType;
use App\Enums\PlaceType;
use App\Enums\ResourceType;
use App\Models\Material;
use App\Models\NaturalResource;
use App\Models\Place;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $place = Place::factory()->create([
            'type' => PlaceType::Forrest,
            'name' => "A quite and shinny forrest",
            'description' => "Description to A quite and shinny forrest",
        ]);

        User::factory()->create([
            'kind' => Kind::Santa,
            'name' => 'Santa Boss',
            'email' => 'santa-boss@example.com',
            'place_id' => $place->id,
        ]);

        $elf = User::factory()->create([
            'kind' => Kind::Elf,
            'name' => 'Elf test',
            'email' => 'elf-test@example.com',
            'place_id' => $place->id,
        ]);

        $token = $elf->createToken('secret-name');
        echo "Copy this toke to use elf <{$token->plainTextToken}>";

        $pine = NaturalResource::factory()->create([
            'name' => "Pine",
            'description' => "A big and old 🌲Pine.",
            'action_point' => '17',
            'experience_point' => '8',
            'damage_point' => '5',
        ]);

        $palm = NaturalResource::factory()->create([
            'name' => "Palm",
            'description' => "A big 🌴 Palm tree.",
            'action_point' => '14',
            'experience_point' => '7',
            'damage_point' => '4',
        ]);

        $trunk = Material::factory()->create([
            'name' => '🪵Trunk',
            'type' => MaterialType::Wood->value,
            'cost' => 20,
            'weight' => 10,
        ]);

        $leaf = Material::factory()->create([
            'name' => '🍃Small bag of Leafs',
            'type' => MaterialType::Vegetable->value,
            'cost' => 2,
            'weight' => 1,
        ]);

        $bigLeaf = Material::factory()->create([
            'name' => '🌿Big Leaf of palm',
            'type' => MaterialType::Vegetable->value,
            'cost' => 3,
            'weight' => 2,
        ]);

        $cocoNut = Material::factory()->create([
            'name' => '🥥Coco nut',
            'type' => MaterialType::Fruit->value,
            'cost' => 6,
            'weight' => 4,
        ]);

        $pine->materials()->attach([
            $trunk->id => ['min_quantity' => 3, 'max_quantity' => 5],
            $leaf->id => ['min_quantity' => 2, 'max_quantity' => 8],
        ]);

        $palm->materials()->attach([
            $trunk->id => ['min_quantity' => 2, 'max_quantity' => 4],
            $bigLeaf->id => ['min_quantity' => 2, 'max_quantity' => 6],
            $cocoNut->id => ['min_quantity' => 1, 'max_quantity' => 4],
        ]);

        $place->resources()->attach([
            $pine->id => ['quantity'=> 10],
        ]);

        $place->exits()->attach([
            $place->id => ['direction' => Direction::North],
        ]);
    }
}
