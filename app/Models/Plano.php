<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plano extends Model
{
    protected $table = 'planos';

    protected function casts(): array
    {
        return [
            'valor' => 'decimal:2',
            'ativo' => 'boolean',
        ];
    }

    // Um plano tem muitas inscrições
    public function inscricoes(): HasMany
    {
        return $this->hasMany(Inscricao::class, 'plano_id');
    }
}
