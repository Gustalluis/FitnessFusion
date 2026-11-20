<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected function casts(): array
    {
        return [
            'data_nascimento' => 'date',
        ];
    }

    // O cliente pertence a um user (a FK user_id está nesta tabela)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Um cliente tem várias inscrições ao longo do tempo
    public function inscricoes(): HasMany
    {
        return $this->hasMany(Inscricao::class);
    }
}
