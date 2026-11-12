<?php

namespace App\Enums;

enum MonsterType
{
    case RAT = 'Rato';
    case SLIME = 'Gosma';
    case SKELETON = 'Esqueleto';
    case SPIDER = 'Aranha';
    case GHOST = 'Fantasma';
    case WITCH = 'Bruxa';
    case DRAGON = 'Dragão';

    public function label(): string
    {
        return match ($this) {
            self::RAT => 'Rato',
            self::SLIME => 'Gosma',
            self::SKELETON => 'Esqueleto',
            self::SPIDER => 'Aranha',
            self::GHOST => 'Fantasma',
            self::WITCH => 'Bruxa',
            self::DRAGON => 'Dragão',
        };
    }
   
}
