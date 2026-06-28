<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;

/**
 * CONTROLLER - HomeController
 * Responsável pela tela inicial do sistema.
 * Busca categorias e produtos em destaque para exibir na home.
 */
class HomeController extends Controller
{
    /**
     * INDEX - Exibe a tela inicial
     * MODEL: busca categorias e os 6 primeiros produtos
     * VIEW: renderiza 'home.blade.php'
     */
    public function index()
    {
        $categorias = Categoria::all();
        $produtos = Produto::take(6)->get();

        return view('home', compact('categorias', 'produtos'));
    }
}