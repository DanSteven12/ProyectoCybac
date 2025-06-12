<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class MembresiaPorVencerNotification extends Notification
{
    use Queueable;

    public $diasRestantes;

    public function __construct($diasRestantes)
    {
        $this->diasRestantes = $diasRestantes;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $diasTexto = $this->diasRestantes == 1 ? '1 día' : "{$this->diasRestantes} días";

        return (new MailMessage)
            ->subject("Tu membresía vence en {$diasTexto}")
            ->greeting("Hola {$notifiable->name},")
            ->line("Tu membresía está por vencer.")
            ->line("Te quedan {$diasTexto} para renovarla.")
            ->action('Renovar ahora', url('/membresia/renovar'))
            ->line('Gracias por usar nuestra plataforma.');
    }
}
