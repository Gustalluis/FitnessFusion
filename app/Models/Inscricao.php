<?php

namespace App\Models;

use App\Enums\StatusInscricao;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inscricao extends Model
{
    protected $table = 'inscricoes';

    protected function casts(): array
    {
        return [
            'status' => StatusInscricao::class,
            'data_inicio' => 'date',
            'data_termino' => 'date',
            'valor_contratado' => 'decimal:2',
        ];
    }

    // Uma inscrição pertence a um Cliente
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    // Uma inscrição pertence a um Plano
    public function plano(): BelongsTo
    {
        return $this->belongsTo(Plano::class, 'plano_id');
    }
}
