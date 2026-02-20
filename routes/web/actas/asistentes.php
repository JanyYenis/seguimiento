<?php

use App\Http\Controllers\AsistenteController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "/asistentes",  "as" => "asistentes."], function () {
    Route::get('{acta}/listado', [AsistenteController::class, 'listado'])->name('listado');
    Route::post('/guardar', [AsistenteController::class, 'store'])->name('store');
    Route::get('{asistente}/editar', [AsistenteController::class, 'edit'])->name('edit');
    Route::put('{asistente}/actualizar', [AsistenteController::class, 'update'])->name('update');
    Route::delete('{asistente}/eliminar', [AsistenteController::class, 'delete'])->name('delete');
});
