<?php

namespace App\Enums;

enum NPCClass
{
    case SELLER = 'Vendedor';

    public function label(): string
    {
        return match ($this) {
            self::SELLER => 'Vendedor',
        };
    }
}
