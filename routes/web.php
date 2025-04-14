<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CocktailController;

Auth::routes();
Route::get('/', [CocktailController::class, 'index'])->name('cocktails.index');
Route::get('/home', [CocktailController::class, 'index'])->name('cocktails.index');

Route::middleware('auth')->group(function () {
    // Ruta para almacenar un cóctel (desde el frontend)
    Route::get('/cocktails/manage', [CocktailController::class, 'manage'])->name('cocktails.manage');
});


