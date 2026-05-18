<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

/**
 * Canal simulado de WhatsApp — registra no log como se fosse um disparo real.
 * Substitua por uma integração com a API do WhatsApp Business em produção.
 */
class WhatsAppLogChannel
{
    public function send(object $notifiable, Notification $notification): void
    {
        if (! method_exists($notification, 'toWhatsApp')) {
            return;
        }

        $mensagem = $notification->toWhatsApp($notifiable);

        Log::channel('stack')->info('📱 [SAFE] WhatsApp Simulado — disparo registrado', [
            'destinatario' => $notifiable->nome,
            'numero'       => $notifiable->telefone,
            'mensagem'     => $mensagem,
            'timestamp'    => now()->format('d/m/Y H:i:s'),
            'status'       => 'ENVIADO (simulado)',
        ]);
    }
}
