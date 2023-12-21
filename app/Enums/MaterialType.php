<?php

declare(strict_types=1);

namespace App\Enums;

enum MaterialType: string
{
    case Fruit = 'fruit';
    case Vegetable = 'vegetable';
    case Food = 'food';
    case Wood = 'wood';
}
