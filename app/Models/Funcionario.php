<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'funcionarios';

    protected function casts(): array
    {
        return [
            'data_admissao' => 'date',
            'salario' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
