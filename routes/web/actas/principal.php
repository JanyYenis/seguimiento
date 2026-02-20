<?php

use App\Http\Controllers\ActaReunionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ActaReunionController::class, 'index'])->name('index');
Route::get('/listado', [ActaReunionController::class, 'listado'])->name('listado');
Route::post('/guardar', [ActaReunionController::class, 'store'])->name('store');
Route::get('{acta}/editar', [ActaReunionController::class, 'edit'])->name('edit');
Route::put('{acta}/actualizar', [ActaReunionController::class, 'update'])->name('update');
Route::delete('{acta}/eliminar', [ActaReunionController::class, 'delete'])->name('delete');
Route::get('{acta}/ver', [ActaReunionController::class, 'verActa'])->name('ver-acta');

include 'asistentes.php';
include 'puntos.php';
