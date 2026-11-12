<?php

namespace App\Enums;

enum ArmorFamily
{
    case HEAVY = 'Pesada';
    case CLOTH = 'Tecido';
    case LEATHER = 'Couro';

    public function label(): string
    {
        return match ($this) {
            self::HEAVY => 'Pesada',
            self::CLOTH => 'Tecido',
            self::LEATHER => 'Couro',
        };
    }
}