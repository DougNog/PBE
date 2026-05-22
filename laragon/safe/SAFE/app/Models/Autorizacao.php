<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Autorizacao extends Model
{
    protected $table = 'autorizacoes';

    protected $fillable = [
        'aluno_id', 'responsavel_id', 'aprovado_por', 'professor_id',
        'tipo', 'status', 'motivo', 'validade_inicio', 'validade_fim', 'faltas',
    ];

    protected function casts(): array
    {
        return [
            'validade_inicio' => 'datetime',
            'validade_fim'    => 'datetime',
        ];
    }

    public function aluno(): BelongsTo
    {
        return $this->belongsTo(Aluno::class);
    }

    public function responsavel(): BelongsTo
    {
        return $this->belongsTo(Responsavel::class);
    }

    public function aprovadoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'aprovado_por');
    }

    public function professor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'professor_id');
    }

    public function getTipoLabelAttribute(): string
    {
        return match ($this->tipo) {
            'saida'  => 'Saída',
            'entrada' => 'Entrada',
            'ambos'  => 'Entrada e Saída',
            default  => $this->tipo,
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'ativa'              => 'Ativa',
            'expirada'           => 'Expirada',
            'revogada'           => 'Revogada',
            'pendente_professor' => 'Pendente (Professor)',
            default              => $this->status,
        };
    }
}
