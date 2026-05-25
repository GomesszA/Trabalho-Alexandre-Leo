<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\PedidoController;

Route::redirect('/', '/categorias');

Route::resource('categorias', CategoriaController::class);
Route::resource('produtos', ProdutoController::class);
Route::resource('pedidos', PedidoController::class);