<?php

namespace App\Enums;

enum MonsterAbility
{
    case DOUBLE_ATTACK = 'Ataque Duplo'; // Rato às vezes ataca duas vezes
    case WEB = 'Teia';  // Aranha prende, o herói perde um turno
    case INTANGIBLE = 'Intangível'; // Fantasma faz com que ataques físicos podem atravessar
    case CURSE = 'Maldição'; // Bruxa reduz o dano do herói por alguns turnos
    case THREE_HEADS = 'Três Cabeças';  // Dragão faz com que cada turno uma cabeça diferente ataca

    public function label(): string
    {
        return match ($this) {
            self::DOUBLE_ATTACK => 'Ataque Duplo',
            self::WEB => 'Teia',
            self::INTANGIBLE => 'Intangível',
            self::CURSE => 'Maldição',
            self::THREE_HEADS => 'Três Cabeças',
        };
    }
}
