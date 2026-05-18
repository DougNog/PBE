<?php

namespace App\Events;

use App\Models\Movimentacao;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AlunoMovimentado
{
    use Dispatchable, SerializesModels;

    public function __construct(public readonly Movimentacao $movimentacao)
    {
    }
}
