<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ContadorController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/productos');

Route::resource('productos', ProductoController::class)->except(['show']);
Route::resource('contadores', ContadorController::class)->parameters(['contadores' => 'contador']);
