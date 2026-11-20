<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Funcionario extends Model
{
    protected $table = 'funcionarios';

    protected function casts(): array
    {
        return [
            'data_nascimento' => 'date',
            'data_admissao' => 'date',
            'salario' => 'decimal:2',
        ];
    }

    // O funcionário pertence a um user (a FK user_id está nesta tabela)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
