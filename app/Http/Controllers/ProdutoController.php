<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;

/**
 * CONTROLLER - Camada de controle do MVC
 * Responsável por receber as requisições HTTP, processar
 * a lógica de negócio e retornar a resposta correta (view ou redirect).
 */
class ProdutoController extends Controller
{
    /**
     * INDEX - Lista produtos, filtrando por categoria se informado
     */
    public function index(Request $request)
    {
        $categorias = Categoria::all();
        $categoriaSelecionada = null;

        // Filtra por categoria se o parâmetro for enviado
        if ($request->categoria_id) {
            $produtos = Produto::where('categoria_id', $request->categoria_id)->get();
            $categoriaSelecionada = Categoria::find($request->categoria_id);
        } else {
            $produtos = Produto::all();
        }

        return view('produtos.index', compact('produtos', 'categorias', 'categoriaSelecionada'));
    }

    /**
     * CREATE - Exibe formulário de criação com lista de categorias
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('produtos.create', compact('categorias'));
    }

    /**
     * STORE - Salva novo produto com imagem e categoria
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome'         => 'required|string|max:255',
            'descricao'    => 'required|string',
            'preco'        => 'required|numeric|min:0',
            'estoque'      => 'required|integer|min:0',
            'categoria_id' => 'nullable|exists:categorias,id',
            'imagem'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagemPath = null;
        if ($request->hasFile('imagem')) {
            $imagemPath = $request->file('imagem')->store('produtos', 'public');
        }

        Produto::create([
            'nome'         => $request->nome,
            'descricao'    => $request->descricao,
            'preco'        => $request->preco,
            'estoque'      => $request->estoque,
            'categoria_id' => $request->categoria_id,
            'imagem'       => $imagemPath,
        ]);

        return redirect()->route('produtos.index');
    }

    /**
     * EDIT - Exibe formulário de edição com categorias
     */
    public function edit(Produto $produto)
    {
        $categorias = Categoria::all();
        return view('produtos.edit', compact('produto', 'categorias'));
    }

    /**
     * UPDATE - Atualiza produto
     */
    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'nome'         => 'required|string|max:255',
            'descricao'    => 'required|string',
            'preco'        => 'required|numeric|min:0',
            'estoque'      => 'required|integer|min:0',
            'categoria_id' => 'nullable|exists:categorias,id',
            'imagem'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagemPath = $produto->imagem;
        if ($request->hasFile('imagem')) {
            $imagemPath = $request->file('imagem')->store('produtos', 'public');
        }

        $produto->update([
            'nome'         => $request->nome,
            'descricao'    => $request->descricao,
            'preco'        => $request->preco,
            'estoque'      => $request->estoque,
            'categoria_id' => $request->categoria_id,
            'imagem'       => $imagemPath,
        ]);

        return redirect()->route('produtos.index');
    }

    /**
     * DESTROY - Exclui produto
     */
    public function destroy(Produto $produto)
    {
        if ($produto->imagem) {
            \Storage::disk('public')->delete($produto->imagem);
        }
        $produto->delete();
        return redirect()->route('produtos.index');
    }
}