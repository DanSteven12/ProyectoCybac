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
        $mail = new MailMessage;

        // Detectar si es texto personalizado (ej: 'menos de 5 horas') o un número de días
        if (is_numeric($this->diasRestantes)) {
            $diasTexto = $this->diasRestantes == 1 ? '1 día' : "{$this->diasRestantes} días";

            $mail->subject("Tu membresía vence en {$diasTexto}")
                 ->line("Hola {$notifiable->name}, tu membresía está por vencer.")
                 ->line("Te quedan {$diasTexto} para renovarla.");
        } else {
            $mail->subject("Tu membresía vence en {$this->diasRestantes}")
                 ->line("Hola {$notifiable->name}, tu membresía vence pronto.")
                 ->line("Te queda {$this->diasRestantes} para renovarla.");
        }

        $mail->action('Renovar ahora', url('/membresia/renovar'))
             ->line('Gracias por usar nuestra plataforma.');

        return $mail;
    }
}
