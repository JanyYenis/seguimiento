<?php

namespace App\Traits;

use App\Models\Sistema\Actividad;
use Illuminate\Support\Facades\Auth;

trait Actividable
{
    public static function bootActividable()
    {
        static::created(function ($model) {
            $model->startRecordingActivity('created');
        });

        static::updating(function ($model) {
            $model->startRecordingActivity('updated');
        });

        static::deleting(function ($model) {
            $model->startRecordingActivity('deleted');
        });
    }

    protected function startRecordingActivity($event)
    {
        // Asegúrate de que el usuario esté autenticado
        if (Auth::check()) {
            $this->recordActivity($event);
        }
    }

    protected function recordActivity($event)
    {
        $activity = [
            'cod_usuario' => Auth::id(),
            'accion' => $event,
            'actividable_id' => $this->id,
            'actividable_type' => get_class($this),
            'changes' => $this->activityChanges($event),
            // 'created_at' => now(),
            // 'updated_at' => now()
        ];

        Actividad::create($activity);
    }

    protected function activityChanges($event)
    {
        if ($event == 'updated') {
            return json_encode([
                'before' => array_diff($this->getOriginal(), $this->getAttributes()),
                'after' => $this->getChanges(),
            ]);
        }

        return null;
    }
}
