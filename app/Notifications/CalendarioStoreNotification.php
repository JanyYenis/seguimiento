<?php

namespace App\Notifications;

use App\Models\Calendario;
use App\Models\Usuario;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CalendarioStoreNotification extends Notification
{
    use Queueable;

    public $usuario = null;
    public $calendario = null;

    /**
     * Create a new notification instance.
     */
    public function __construct(Usuario $usuario, Calendario $calendario)
    {
        $this->usuario = $usuario;
        $this->calendario = $calendario;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->calendario->id,
            'titulo' => "Evento {$this->calendario?->nombre}.",
            'mensaje' => 'Se creo un nuevo evento entre el '.$this->calendario->fecha_inicio.' y '.$this->calendario->fecha_fin,
            'icono' => 'fas fa-calendar-alt',
            'color' => 'primary',
            'ruta' => route('calendario.index'),
        ];
    }
}
