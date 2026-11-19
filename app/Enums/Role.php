<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'admin';
    case Aluno = 'aluno';
    case Funcionario = 'funcionario';

    public function podeAcessarPainel(): bool
    {
        return match ($this) {
            self::Admin, self::Funcionario => true,
            self::Aluno => false,
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Administrador',
            self::Aluno => 'Aluno',
            self::Funcionario => 'Funcionário',
        };
    }
}
