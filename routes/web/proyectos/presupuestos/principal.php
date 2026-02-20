<?php

use App\Http\Controllers\PresupuestoProyectoController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "/presupuestos",  "as" => "presupuestos."], function () {
    Route::post('/crear', [PresupuestoProyectoController::class, 'store'])->name('store');
    Route::put('/actualizar/{presupuesto}', [PresupuestoProyectoController::class, 'update'])->name('update');
    Route::delete('/eliminar/{presupuesto}', [PresupuestoProyectoController::class, 'delete'])->name('delete');
});