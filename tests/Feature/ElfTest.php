<?php

declare(strict_types=1);

use App\Enums\Kind;
use App\Models\User;

it('can see his stats', function (): void {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->get('/api/me');

    $stats = $response->json();

    expect($stats)->toMatchArray([
        'kind' => Kind::Elf->value,
        'health' => [
            'current' => Kind::Elf->healthMax(),
            'max' => Kind::Elf->healthMax(),
        ],
        'crystal' => [
            'current' => Kind::Elf->crystalMax(),
            'max' => Kind::Elf->crystalMax(),
        ],
        'action' => [
            'current' => Kind::Elf->actionMax(),
            'max' => Kind::Elf->actionMax(),
        ],
        'level' => 1,
        'experience' => 0,
        'stars' => 0,
    ]);
});
