@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>🧾 Pedidos</h2>
    <a href="{{ route('pedidos.create') }}" class="btn btn-success">+ Novo Pedido</a>
</div>

@if($pedidos->isEmpty())
    <div class="alert alert-info text-center">Nenhum pedido ainda.</div>
@else
<div class="row row-cols-1 row-cols-md-2 g-4">
    @foreach($pedidos as $pedido)
    <div class="col">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                <span class="fw-bold">Pedido #{{ $pedido->id }}</span>
                <span class="badge {{ $pedido->status == 'aberto' ? 'bg-success' : 'bg-secondary' }}">
                    {{ ucfirst($pedido->status) }}
                </span>
            </div>
            <div class="card-body">
                {{-- Fotos dos produtos do pedido --}}
                <div class="d-flex gap-2 flex-wrap mb-3">
                    @foreach($pedido->itens as $item)
                        @if($item->produto && $item->produto->imagem)
                            <img src="{{ asset('storage/' . $item->produto->imagem) }}"
                                 alt="{{ $item->produto->nome }}"
                                 style="width:60px; height:60px; object-fit:cover; border-radius:8px;"
                                 title="{{ $item->quantidade }}x {{ $item->produto->nome }}">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-secondary rounded"
                                 style="width:60px; height:60px; font-size:1.5rem;"
                                 title="{{ $item->quantidade }}x {{ $item->produto->nome ?? 'Produto' }}">
                                🍽️
                            </div>
                        @endif
                    @endforeach
                </div>

                {{-- Itens do pedido --}}
                <ul class="list-unstyled small text-muted mb-2">
                    @foreach($pedido->itens as $item)
                        <li>{{ $item->quantidade }}x {{ $item->produto->nome ?? 'Produto removido' }}
                            — R$ {{ number_format($item->preco_unitario * $item->quantidade, 2, ',', '.') }}
                        </li>
                    @endforeach
                </ul>

                {{-- Pagamento --}}
                @if($pedido->pagamento)
                <p class="small mb-1">
                    💳 <strong>Pagamento:</strong>
                    @if($pedido->pagamento == 'dinheiro') 💵 Dinheiro
                    @elseif($pedido->pagamento == 'cartao') 💳 Cartão
                    @elseif($pedido->pagamento == 'pix') 📱 Pix
                    @endif
                </p>
                @endif

                @if($pedido->troco)
                <p class="small mb-1">💵 <strong>Troco para:</strong> R$ {{ number_format($pedido->troco, 2, ',', '.') }}</p>
                @endif
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center border-0">
                <span class="fw-bold text-success fs-5">
                    R$ {{ number_format($pedido->total, 2, ',', '.') }}
                </span>
                <div class="d-flex gap-2">
                    <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Excluir?')">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection