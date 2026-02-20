<?php

use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MailController::class, 'index'])->name('index');
Route::get('/listado', [MailController::class, 'listado'])->name('listado');
Route::post('/crear', [MailController::class, 'store'])->name('store');
Route::get('/editar/{ticket}', [MailController::class, 'edit'])->name('edit');
Route::put('/actualizar/{ticket}', [MailController::class, 'update'])->name('update');
