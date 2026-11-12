<?php

namespace App\Enums;

enum CharacterClass
{
    case KNIGHT = "Cavaleiro";
    case MAGE = "Mago";
    case ROGUE = "Ladino";
    case ARCHER = "Arqueiro";
    
    public function label(): string
    {
        return match ($this) {
            self::KNIGHT => "Cavaleiro",
            self::MAGE => "Mago",
            self::ROGUE => "Ladino",
            self::ARCHER => "Arqueiro",
        };
    }

    public function baseAttributes(): array
    {
        return match ($this) {
            self::KNIGHT => ['strength' => 5, 'intelligence' => 1, 'agility' => 2, 'vitality' => 6],
            self::MAGE => ['strength' => 1, 'intelligence' => 6, 'agility' => 2, 'vitality' => 3],
            self::ROGUE => ['strength' => 2, 'intelligence' => 2, 'agility' => 6, 'vitality' => 4],
            self::ARCHER => ['strength' => 3, 'intelligence' => 2, 'agility' => 5, 'vitality' => 4],
        };
    }

    public function mainAttribute(): string
    {
        return match ($this) {
            self::KNIGHT => 'strength',
            self::MAGE => 'intelligence',
            self::ROGUE, self::ARCHER => 'agility',
        };
    }
}
