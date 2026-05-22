<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aluno extends Model
{
    protected $fillable = ['nome', 'matricula', 'turma', 'foto_path', 'ativo'];

    protected function casts(): array
    {
        return ['ativo' => 'boolean'];
    }

    public function responsaveis(): BelongsToMany
    {
        return $this->belongsToMany(Responsavel::class, 'aluno_responsavel')
            ->withPivot('parentesco')
            ->withTimestamps();
    }

    public function autorizacoes(): HasMany
    {
        return $this->hasMany(Autorizacao::class);
    }

    public function movimentacoes(): HasMany
    {
        return $this->hasMany(Movimentacao::class);
    }

    public function autorizacaoAtiva(string $tipo = 'saida'): ?Autorizacao
    {
        return $this->autorizacoes()
            ->where('status', 'ativa')
            ->where(fn ($q) => $q->where('tipo', $tipo)->orWhere('tipo', 'ambos'))
            ->where(fn ($q) => $q
                ->whereNull('validade_fim')
                ->orWhere('validade_fim', '>=', now())
            )
            ->latest()
            ->first();
    }
}
