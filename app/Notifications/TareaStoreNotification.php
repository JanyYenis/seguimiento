<?php

namespace App\Notifications;

use App\Models\Tarea;
use App\Models\Usuario;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TareaStoreNotification extends Notification
{
    use Queueable;

    public $usuario = null;
    public $tarea = null;

    /**
     * Create a new notification instance.
     */
    public function __construct(Usuario $usuario, Tarea $tarea)
    {
        $this->usuario = $usuario;
        $this->tarea = $tarea;
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
            'id' => $this->tarea->id,
            'titulo' => "{$this->tarea?->titulo}.",
            'mensaje' => 'Se creo una nueva tarea con fechas de '.$this->tarea->fecha_inicio.' y '.$this->tarea->fecha_fin,
            'icono' => 'fas fa-clipboard-list',
            'color' => 'info',
            'ruta' => route('proyectos.edit', ['proyecto' =>  $this->tarea->cod_proyecto]),
        ];
    }
}
