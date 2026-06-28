@extends('layouts.app')

@section('content')
{{-- HERO - Banner principal --}}
<div class="rounded-4 text-white text-center py-5 mb-5"
     style="background: linear-gradient(135deg, #1a1a1a, #ff6b00); min-height: 300px; display:flex; flex-direction:column; align-items:center; justify-content:center;">
    <div style="font-size: 4rem;">🍔</div>
    <h1 class="fw-bold mt-2">Bem-vindo à Lancheria!</h1>
    <p class="fs-5 text-white-50">Os melhores lanches da cidade, feitos com amor ❤️</p>
    <a href="{{ route('pedidos.create') }}" class="btn btn-warning btn-lg mt-3 fw-bold px-5">
        Fazer Pedido
    </a>
</div>

{{-- CATEGORIAS --}}
@if($categorias->count() > 0)
<h4 class="fw-bold mb-3">🍽️ Categorias</h4>
<div class="row row-cols-2 row-cols-md-4 g-3 mb-5">
    @foreach($categorias as $categoria)
    <div class="col">
        <a href="{{ route('produtos.index', ['categoria_id' => $categoria->id]) }}" class="text-decoration-none">
            <div class="card text-center border-0 shadow-sm h-100"
                 style="cursor:pointer; transition: transform 0.2s;"
                 onmouseover="this.style.transform='scale(1.05)'"
                 onmouseout="this.style.transform='scale(1)'">
                <div class="card-body py-4">
                    <div style="font-size: 2.5rem;">
                        @if(str_contains(strtolower($categoria->nome), 'pizza'))🍕
                        @elseif(str_contains(strtolower($categoria->nome), 'hambur') || str_contains(strtolower($categoria->nome), 'lanche'))🍔
                        @elseif(str_contains(strtolower($categoria->nome), 'bebida') || str_contains(strtolower($categoria->nome), 'suco'))🥤
                        @elseif(str_contains(strtolower($categoria->nome), 'sobremesa') || str_contains(strtolower($categoria->nome), 'doce'))🍰
                        @elseif(str_contains(strtolower($categoria->nome), 'frango'))🍗
                        @else🍽️
                        @endif
                    </div>
                    <h6 class="mt-2 text-dark fw-bold">{{ $categoria->nome }}</h6>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
@endif

{{-- PRODUTOS EM DESTAQUE --}}
@if($produtos->count() > 0)
<h4 class="fw-bold mb-3">⭐ Destaques do Cardápio</h4>
<div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
    @foreach($produtos as $produto)
    <div class="col">
        <div class="card h-100 shadow-sm border-0">
            @if($produto->imagem)
                <img src="{{ asset('storage/' . $produto->imagem) }}"
                     class="card-img-top"
                     alt="{{ $produto->nome }}"
                     style="height: 200px; object-fit: cover;">
            @else
                <div class="bg-secondary d-flex align-items-center justify-content-center"
                     style="height: 200px;">
                    <span style="font-size: 4rem;">🍽️</span>
                </div>
            @endif
            <div class="card-body">
                <h5 class="card-title fw-bold">{{ $produto->nome }}</h5>
                <p class="card-text text-muted small">{{ $produto->descricao }}</p>
            </div>
            <div class="card-footer border-0 d-flex justify-content-between align-items-center">
                <span class="fw-bold text-success fs-5">
                    R$ {{ number_format($produto->preco, 2, ',', '.') }}
                </span>
                <a href="{{ route('pedidos.create') }}" class="btn btn-warning btn-sm fw-bold">
                    Pedir agora
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

{{-- RODAPÉ --}}
<footer class="text-center text-muted py-4 border-top mt-4">
    <p>🍔 Lancheria © {{ date('Y') }} — Feito com muito amor e código!</p>
</footer>
@endsection