@extends('layouts.app')

@section('content')
{{-- Título com filtro ativo --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>
        @if($categoriaSelecionada)
            🍽️ {{ $categoriaSelecionada->nome }}
        @else
            🍔 Cardápio
        @endif
    </h2>
    <div class="d-flex gap-2">
        @if($categoriaSelecionada)
            <a href="{{ route('produtos.index') }}" class="btn btn-outline-secondary btn-sm">Ver todos</a>
        @endif
        <a href="{{ route('produtos.create') }}" class="btn btn-success">+ Novo Produto</a>
    </div>
</div>

{{-- Filtro por categorias --}}
<div class="d-flex gap-2 flex-wrap mb-4">
    <a href="{{ route('produtos.index') }}"
       class="btn btn-sm {{ !$categoriaSelecionada ? 'btn-dark' : 'btn-outline-dark' }}">
        Todos
    </a>
    @foreach($categorias as $categoria)
    <a href="{{ route('produtos.index', ['categoria_id' => $categoria->id]) }}"
       class="btn btn-sm {{ $categoriaSelecionada?->id == $categoria->id ? 'btn-dark' : 'btn-outline-dark' }}">
        @if(str_contains(strtolower($categoria->nome), 'pizza'))🍕
        @elseif(str_contains(strtolower($categoria->nome), 'hambur') || str_contains(strtolower($categoria->nome), 'lanche'))🍔
        @elseif(str_contains(strtolower($categoria->nome), 'bebida'))🥤
        @elseif(str_contains(strtolower($categoria->nome), 'sobremesa'))🍰
        @else🍽️
        @endif
        {{ $categoria->nome }}
    </a>
    @endforeach
</div>

@if($produtos->isEmpty())
    <div class="alert alert-info text-center">
        Nenhum produto encontrado nessa categoria.
    </div>
@else
    <div class="row row-cols-1 row-cols-md-3 g-4">
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
                        <span class="text-white fs-1">🍽️</span>
                    </div>
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $produto->nome }}</h5>
                    @if($produto->categoria)
                        <span class="badge bg-warning text-dark mb-2">{{ $produto->categoria->nome }}</span>
                    @endif
                    <p class="card-text text-muted small">{{ $produto->descricao }}</p>
                </div>

                <div class="card-footer d-flex justify-content-between align-items-center border-0">
                    <div>
                        <span class="fw-bold text-success fs-5">
                            R$ {{ number_format($produto->preco, 2, ',', '.') }}
                        </span>
                        <br>
                        <small class="text-muted">Estoque: {{ $produto->estoque }}</small>
                    </div>
                    <div class="d-flex gap-1">
                        <a href="{{ route('produtos.edit', $produto->id) }}"
                           class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('produtos.destroy', $produto->id) }}"
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Excluir produto?')">Excluir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection