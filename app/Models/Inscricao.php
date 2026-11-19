<?php

namespace App\Models;

use App\Enums\StatusInscricao;
use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
    protected $table = 'inscricoes';

    protected function casts(): array
    {
        return [
            'status' => StatusInscricao::class,
        ];
    }

    // Uma inscrição pertence a um Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    // Uma inscrição pertence a um Plano
    public function plano()
    {
        return $this->belongsTo(Plano::class, 'plano_id');
    }
}
