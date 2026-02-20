<?php

use App\Http\Controllers\ServicioCuentaCobroController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "/servicios",  "as" => "servicios."], function () {
    Route::get('{cuenta}/listado', [ServicioCuentaCobroController::class, 'listado'])->name('listado');
    Route::post('/guardar', [ServicioCuentaCobroController::class, 'store'])->name('store');
    Route::get('{servicio}/editar', [ServicioCuentaCobroController::class, 'edit'])->name('edit');
    Route::put('{servicio}/actualizar', [ServicioCuentaCobroController::class, 'update'])->name('update');
    Route::delete('{servicio}/eliminar', [ServicioCuentaCobroController::class, 'delete'])->name('delete');
    Route::get('{proyecto}/buscar-fases', [ServicioCuentaCobroController::class, 'buscarFases'])->name('buscar-fases');
});
