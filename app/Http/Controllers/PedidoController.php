<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;
use App\Models\ItensPedido;
use App\Models\Categoria;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::all();
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $produtos = Produto::all();
        $categorias = Categoria::all();
        return view('pedidos.create', compact('produtos', 'categorias'));
    }

    public function store(Request $request)
    {
        // Filtra apenas produtos com quantidade maior que zero
        $produtos = collect($request->produtos)->filter(fn($item) => $item['quantidade'] > 0);

        // Verifica se pelo menos um produto foi selecionado
        if ($produtos->isEmpty()) {
            return back()->withErrors(['produtos' => 'Selecione ao menos um produto.']);
        }

        $pedido = Pedido::create([
            'user_id'   => auth()->id(),
            'status'    => 'aberto',
            'pagamento' => $request->pagamento ?? 'dinheiro',
            'troco'     => $request->pagamento === 'dinheiro' ? $request->troco : null,
            'total'     => 0,
        ]);

        $total = 0;
        foreach ($produtos as $item) {
            $produto = Produto::find($item['produto_id']);
            ItensPedido::create([
                'pedido_id'      => $pedido->id,
                'produto_id'     => $produto->id,
                'quantidade'     => $item['quantidade'],
                'preco_unitario' => $produto->preco,
            ]);
            $total += $produto->preco * $item['quantidade'];
        }

        $pedido->update(['total' => $total]);
        return redirect()->route('pedidos.index');
    }

    public function edit(Pedido $pedido)
    {
        return view('pedidos.edit', compact('pedido'));
    }

    public function update(Request $request, Pedido $pedido)
    {
        $pedido->update(['status' => $request->status]);
        return redirect()->route('pedidos.index');
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return redirect()->route('pedidos.index');
    }
}