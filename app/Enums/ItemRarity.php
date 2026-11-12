<?php

namespace App\Enums;

enum ItemRarity
{
    case COMMON = "Comum";
    case UNCOMMON = "Incomum";
    case RARE = "Raro";
    case LEGENDARY = "Lendário";

    public function label(): string
    {
        return match ($this) {
            self::COMMON => "Comum",
            self::UNCOMMON => "Incomum",
            self::RARE => "Raro",
            self::LEGENDARY => "Lendário",
        };
    }


    public function multiplier(): float
    {
        return match ($this) {
            self::COMMON => 1.0,
            self::UNCOMMON => 1.5,
            self::RARE => 2.0,
            self::LEGENDARY => 3.0,
        };
    }

    public function priceMultiplier(): int
    {
        return match ($this) {
            self::COMMON => 1,
            self::UNCOMMON => 2,
            self::RARE => 4,
            self::LEGENDARY => 10,
        };
    }
    
}
