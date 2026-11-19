<?php

namespace App\Enums;

enum StatusInscricao: string
{
    case Ativa = 'ativa';
    case Vencida = 'vencida';
    case Cancelada = 'cancelada';

    public function label(): string
    {
        return match ($this) {
            self::Ativa => 'Matrícula ativa',
            self::Vencida => 'Vencida',
            self::Cancelada => 'Cancelada',
        };
    }
}
