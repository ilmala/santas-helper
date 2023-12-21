<?php

declare(strict_types=1);

namespace App\Enums;

enum Kind: string
{
    case Santa = 'santa';
    case Elf = 'elf';

    public function healthMax(): int
    {
        return match ($this) {
            Kind::Santa => 1_000,
            Kind::Elf => 25,
        };
    }

    public function crystalMax(): int
    {
        return match ($this) {
            Kind::Santa => 1_000,
            Kind::Elf => 10,
        };
    }

    public function actionMax(): int
    {
        return match ($this) {
            Kind::Santa => 1_000,
            Kind::Elf => 80,
        };
    }
}
