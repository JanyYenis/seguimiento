<?php

use App\Http\Controllers\PuntoOrdenDiaController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "/puntos",  "as" => "puntos."], function () {
    Route::get('{acta}/listado', [PuntoOrdenDiaController::class, 'listado'])->name('listado');
    Route::post('/guardar', [PuntoOrdenDiaController::class, 'store'])->name('store');
    Route::get('{punto}/editar', [PuntoOrdenDiaController::class, 'edit'])->name('edit');
    Route::put('{punto}/actualizar', [PuntoOrdenDiaController::class, 'update'])->name('update');
    Route::delete('{punto}/eliminar', [PuntoOrdenDiaController::class, 'delete'])->name('delete');
});
