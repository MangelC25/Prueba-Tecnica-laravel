<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CocktailController;


Auth::routes();
Route::get('/', [CocktailController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    // Ruta para almacenar un cóctel (desde el frontend)
    Route::post('/cocktails', [CocktailController::class, 'store']);
    Route::get('/cocktails/manage', [CocktailController::class, 'manage'])
        ->name('cocktails.manage');
});




