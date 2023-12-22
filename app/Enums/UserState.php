<?php

namespace App\Enums;

enum UserState: string
{
    case Wake = 'wake';
    case Rest = 'rest';
    case Sleep = 'sleep';
    case Tired = 'tired';
}
