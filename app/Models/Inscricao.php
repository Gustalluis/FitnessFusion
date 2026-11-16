<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
    protected $table = 'inscricoes';

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