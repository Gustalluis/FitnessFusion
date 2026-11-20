<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function inscricoes(): HasMany
    {
        return $this->hasMany(Inscricao::class);
    }
}
