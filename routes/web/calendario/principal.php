<?php

use App\Http\Controllers\CalendarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CalendarioController::class, 'index'])->name('index');
Route::get('/fechas', [CalendarioController::class, 'consultar'])->name('consultar');
Route::post('/crear', [CalendarioController::class, 'store'])->name('store');
Route::get('/editar/{calendario}', [CalendarioController::class, 'edit'])->name('edit');
Route::put('/actualizar/{calendario}', [CalendarioController::class, 'update'])->name('update');
Route::delete('/eliminar/{calendario}', [CalendarioController::class, 'delete'])->name('delete');