<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    protected $table = 'planos';

    // Um plano tem muitas inscrições
    public function inscricoes()
    {
        return $this->hasMany(Inscricao::class, 'plano_id');
    }
}
