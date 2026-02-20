<?php

use App\Http\Controllers\CuentaCobroController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CuentaCobroController::class, 'index'])->name('index');
Route::get('/listado', [CuentaCobroController::class, 'listado'])->name('listado');
Route::post('/guardar', [CuentaCobroController::class, 'store'])->name('store');
Route::get('{cuenta}/editar', [CuentaCobroController::class, 'edit'])->name('edit');
Route::put('{cuenta}/actualizar', [CuentaCobroController::class, 'update'])->name('update');
Route::delete('{cuenta}/eliminar', [CuentaCobroController::class, 'delete'])->name('delete');
Route::get('{cuenta}/ver', [CuentaCobroController::class, 'ver'])->name('ver');

include 'servicios.php';
