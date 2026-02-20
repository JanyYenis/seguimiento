<?php

use App\Http\Controllers\FaseController;
use Illuminate\Support\Facades\Route;

// Este listado de Fase es de donde se traen los datos que se muestran en la tabla
Route::get('/listadoFase', [FaseController::class, 'index'])->name('listadoFase');


//Ruta para crear Fase
Route::post('/fase', [FaseController::class, 'crear'])->name('crearFase');

// Ruta para editar Fase
Route::get('/editarFase/{id}', [FaseController::class, 'editar'])->name('traerEdit');
Route::post('/editarFaseBack/{id}', [FaseController::class, 'editarBack'])->name('editGuardar');
