<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    // Um cliente tem muitas inscrições
    public function inscricoes()
    {
        return $this->hasMany(Inscricao::class, 'cliente_id');
    }
}
