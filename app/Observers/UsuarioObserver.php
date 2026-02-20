<?php

namespace App\Observers;

use App\Models\Usuario;

class UsuarioObserver
{
    /**
     * Handle the Usuario "created" event.
     */
    public function created(Usuario $usuario): void
    {
        // $usuario->access_token = Usuario::TOKEN;
        // $usuario->saveQuietly();
    }

    /**
     * Handle the Usuario "updated" event.
     */
    public function updated(Usuario $usuario): void
    {
        // $usuario->access_token = Usuario::TOKEN;
        // $usuario->saveQuietly();
    }

    /**
     * Handle the Usuario "deleted" event.
     */
    public function deleted(Usuario $usuario): void
    {
        // $usuario->access_token = Usuario::TOKEN;
        // $usuario->saveQuietly();
    }

    /**
     * Handle the Usuario "restored" event.
     */
    public function restored(Usuario $usuario): void
    {
        //
    }

    /**
     * Handle the Usuario "force deleted" event.
     */
    public function forceDeleted(Usuario $usuario): void
    {
        //
    }
}
