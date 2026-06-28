<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\HomeController;

// Rota principal - tela de início
Route::redirect('/', '/home');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Home
    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::resource('categorias', CategoriaController::class);
    Route::resource('produtos', ProdutoController::class);
    Route::resource('pedidos', PedidoController::class);
});