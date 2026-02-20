<?php

use App\Http\Controllers\TareaController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "/tareas",  "as" => "tareas."], function () {
    Route::get('/', [TareaController::class, 'index'])->name('index');
    Route::get('/listado/{proyecto}', [TareaController::class, 'show'])->name('show');
    Route::post('/crear', [TareaController::class, 'store'])->name('store');
    Route::get('/editar/{tarea}', [TareaController::class, 'edit'])->name('edit');
    Route::put('/actualizar/{tarea}', [TareaController::class, 'update'])->name('update');
    Route::delete('/eliminar/{tarea}', [TareaController::class, 'delete'])->name('delete');

    Route::put('/mover-tarea/{tarea}', [TareaController::class, 'actualizarEstado'])->name('actualizarEstado');
    Route::get('/filtrar', [TareaController::class, 'filtrar'])->name('filtrar');
    Route::post('buscar/usuarios', [TareaController::class, 'buscarUsuarios'])->name('buscarUsuarios');
    Route::post('buscar/fases', [TareaController::class, 'buscarFases'])->name('buscarFases');
});
