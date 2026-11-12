<?php

namespace App\Enums;

enum ItemType
{
    case Weapon = "Arma";
    case Helmet = "Capacete";
    case Armor = "Armadura";
    case Gloves = "Luvas";
    case Boots = "Botas";
    case Potion = "Poção";

    public function label(): string
    {
        return match ($this) {
            self::Weapon => "Arma",
            self::Helmet => "Capacete",
            self::Armor => "Armadura",
            self::Gloves => "Luvas",
            self::Boots => "Botas",
            self::Potion => "Poção",
        };      
    }

    public function isArmor(): bool
    {
        return match ($this)
        {
            self::Helmet, self::Armor, self::Gloves, self::Boots => true,
            default => false,

        };
    }

    public function isWeapon(): bool
    {
        return $this === self::Weapon;
    }

    public function isEquippable(): bool
    {
        return $this->isArmor() || $this->isWeapon();
    }
    
}
