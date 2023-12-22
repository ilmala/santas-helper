<?php

namespace App\Enums;

enum Direction: string
{
    case North = 'n';
    case South = 's';
    case East = 'e';
    case West = 'w';
    case Up = 'u';
    case Down = 'd';
}
