<?php

use App\Http\Controllers\CarnetController;
use Illuminate\Support\Facades\Route;

Route::get('/{usuario}', [CarnetController::class, 'index'])->name('index');
