<?php

namespace App\Models;

use App\Enums\StatusInscricao;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inscricao extends Model
{
    use HasFactory;

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

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function plano(): BelongsTo
    {
        return $this->belongsTo(Plano::class, 'plano_id');
    }
}
