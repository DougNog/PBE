<?php

namespace App\Listeners;

use App\Events\AlunoMovimentado;
use App\Notifications\MovimentacaoNotification;

class NotificarResponsavelListener
{
    public function handle(AlunoMovimentado $event): void
    {
        $movimentacao = $event->movimentacao->load('aluno.responsaveis', 'registradoPor');

        foreach ($movimentacao->aluno->responsaveis as $responsavel) {
            $responsavel->notify(new MovimentacaoNotification($movimentacao));
        }
    }
}
