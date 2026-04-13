<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MovimentacaoEstoque extends Model
{
    protected $table = 'movimentacoes_estoque';

    protected $fillable = [
        'produto_id',
        'tipo',
        'quantidade',
        'motivo',
        'data_movimentacao',
        'observacao',
    ];

    protected $casts = [
        'data_movimentacao' => 'datetime',
    ];

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class);
    }
}