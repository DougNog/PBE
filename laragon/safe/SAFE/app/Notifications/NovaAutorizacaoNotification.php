<?php

namespace App\Notifications;

use App\Models\Autorizacao;
use Illuminate\Notifications\Notification;

class NovaAutorizacaoNotification extends Notification
{
    public function __construct(public readonly Autorizacao $autorizacao) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $aluno   = $this->autorizacao->aluno;
        $horario = $this->autorizacao->validade_inicio?->format('H:i') ?? '—';

        return [
            'autorizacao_id' => $this->autorizacao->id,
            'aluno_nome'     => $aluno->nome,
            'aluno_turma'    => $aluno->turma,
            'horario_saida'  => $horario,
            'faltas'         => $this->autorizacao->faltas,
            'motivo'         => $this->autorizacao->motivo,
        ];
    }
}
