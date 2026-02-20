<?php

use App\Http\Controllers\ProyectoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProyectoController::class, 'index'])->name('index');
Route::get('/chartTota', [ProyectoController::class, 'chartTota'])->name('chartTota');
Route::get('/chartTotaTareas/{proyecto}', [ProyectoController::class, 'chartTotaTareas'])->name('chartTotaTareas');
Route::get('/chartLinea/{proyecto}', [ProyectoController::class, 'chartLinea'])->name('chartLinea');
Route::get('/listado', [ProyectoController::class, 'listado'])->name('listado');
Route::post('/guardar', [ProyectoController::class, 'store'])->name('store');
Route::get('{proyecto}/editar', [ProyectoController::class, 'edit'])->name('edit');
Route::post('{proyecto}/actualizar', [ProyectoController::class, 'update'])->name('update');
Route::post('/{proyecto}/asociar-usuario', [ProyectoController::class, 'asociarUsuario'])->name('asociar-usuario');
Route::delete('{proyecto}/eliminar', [ProyectoController::class, 'delete'])->name('delete');
Route::post('buscar/usuarios', [ProyectoController::class, 'buscarUsuarios'])->name('buscarUsuarios');
Route::get('actualizar-lista-archivos/{proyecto}', [ProyectoController::class, 'actualizarListaArchivos'])->name('actualizarListaArchivos');
Route::get('gantt/{proyecto}', [ProyectoController::class, 'gantt'])->name('gantt');

include 'tareas/principal.php';
include 'presupuestos/principal.php';
