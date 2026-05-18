<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movimentacao extends Model
{
    protected $table = 'movimentacoes';

    protected $fillable = [
        'aluno_id', 'autorizacao_id', 'registrado_por', 'tipo', 'observacao',
    ];

    public function aluno(): BelongsTo
    {
        return $this->belongsTo(Aluno::class);
    }

    public function autorizacao(): BelongsTo
    {
        return $this->belongsTo(Autorizacao::class);
    }

    public function registradoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registrado_por');
    }

    public function getTipoLabelAttribute(): string
    {
        return $this->tipo === 'saida' ? 'Saída' : 'Entrada';
    }

    public function getTipoIconAttribute(): string
    {
        return $this->tipo === 'saida' ? '🚶' : '🏫';
    }
}
