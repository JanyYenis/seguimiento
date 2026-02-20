<?php

namespace App\Traits;

use App\Models\Telefono;

trait TelefonableTrait
{   
    /**
     * Función que permite obtener los telefonos relacionados a un registro.
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany Relación polimórfica.
     */
    public function telefonos()
    {
        return $this->morphMany(Telefono::class, "telefonable");
    }
    
    /**
     * Función que permite obtener un telefono relacionado a un registro.
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne Relación polimórfica.
     */
    public function telefono()
    {
        return $this->morphOne(Telefono::class, "telefonable");
    }

    /**
     * Función que permite obtener el telefono principal relacionados a un registro.
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne Relación polimórfica.
     */
    public function telefonoPrincipal()
    {
        return $this->telefono()->where('principal', Telefono::PRINCIPAL);
    }
    
    /**
     * Función que permite crear un telefono y relacionarlo inmediatamente con el modelo
     * seleccionado.
     * @param array $datos Datos a registrar sobre el telefono.
     */
    public function crearTelefono($datos)
    {
        $telefono = new Telefono($datos);
        $telefono = $this->telefono()->save($telefono);
        if (!$telefono) {
            return [
                'estados' => 'error',
                'mensaje' => 'Ha ocurrido un error al intentar agregar el telefono'
            ];
        }
        return $telefono;
    }
}

