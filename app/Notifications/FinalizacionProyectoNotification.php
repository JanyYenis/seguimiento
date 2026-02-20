<?php

namespace App\Notifications;

use App\Models\Proyecto;
use App\Models\Usuario;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FinalizacionProyectoNotification extends Notification
{
    use Queueable;

    public $usuario = null;
    public $proyecto = null;

    /**
     * Create a new notification instance.
     */
    public function __construct(Usuario $usuario, Proyecto $proyecto)
    {
        $this->usuario = $usuario;
        $this->proyecto = $proyecto;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)->view('mails.proyecto.fin-proyecto', [
            'usuario' => $this->usuario,
            'proyecto' => $this->proyecto,
        ])->subject('Proyecto '.$this->proyecto->nombre.' Completado');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->proyecto->id,
            'titulo' => "{$this->proyecto?->nombre}.",
            'mensaje' => 'Proyecto '.$this->proyecto->nombre.' Completado',
            'icono' => 'fas fa-project-diagram',
            'color' => 'success',
            'ruta' => route('proyectos.edit', ['proyecto' =>  $this->proyecto->id]),
        ];
    }
}
