<?php

namespace App\Notifications;

use App\Channels\WhatsAppLogChannel;
use App\Models\Movimentacao;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MovimentacaoNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public readonly Movimentacao $movimentacao)
    {
    }

    /** @return array<int, string> */
    public function via(object $notifiable): array
    {
        return ['mail', WhatsAppLogChannel::class];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $aluno    = $this->movimentacao->aluno;
        $tipo     = $this->movimentacao->tipo === 'saida' ? 'SAÍDA' : 'ENTRADA';
        $horario  = $this->movimentacao->created_at->format('d/m/Y \à\s H:i');
        $porteiro = $this->movimentacao->registradoPor->name;

        return (new MailMessage)
            ->subject("SAFE – {$tipo} registrada: {$aluno->nome}")
            ->greeting("Olá, {$notifiable->nome}!")
            ->line("A **{$tipo}** do(a) aluno(a) **{$aluno->nome}** ({$aluno->turma}) foi registrada.")
            ->line("**Horário:** {$horario}")
            ->line("**Registrado por:** {$porteiro} (Portaria)")
            ->action('Ver Movimentações', url('/movimentacoes'))
            ->line('Este é um aviso automático do Sistema SAFE. Não responda este e-mail.')
            ->salutation('Atenciosamente, Sistema SAFE');
    }

    public function toWhatsApp(object $notifiable): string
    {
        $aluno    = $this->movimentacao->aluno;
        $tipo     = $this->movimentacao->tipo === 'saida' ? '🚶 SAÍDA' : '🏫 ENTRADA';
        $horario  = $this->movimentacao->created_at->format('H:i \d\e d/m/Y');
        $porteiro = $this->movimentacao->registradoPor->name;

        return "Olá, {$notifiable->nome}! {$tipo} registrada: *{$aluno->nome}* ({$aluno->turma}) às {$horario}. Registrado por: {$porteiro}. — Sistema SAFE";
    }
}
