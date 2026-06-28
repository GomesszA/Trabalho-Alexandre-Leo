@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>🍽️ Categorias</h2>
    <a href="{{ route('categorias.create') }}" class="btn btn-success">+ Nova Categoria</a>
</div>

{{-- Cards clicáveis de categoria --}}
<div class="row row-cols-2 row-cols-md-4 g-4 mb-5">
    @foreach($categorias as $categoria)
    <div class="col">
        <a href="{{ route('produtos.index', ['categoria_id' => $categoria->id]) }}"
           class="text-decoration-none">
            <div class="card text-center shadow-sm h-100 border-0"
                 style="cursor:pointer; transition: transform 0.2s;"
                 onmouseover="this.style.transform='scale(1.05)'"
                 onmouseout="this.style.transform='scale(1)'">
                <div class="card-body d-flex flex-column align-items-center justify-content-center py-4">
                    {{-- Emoji baseado no nome da categoria --}}
                    <div style="font-size: 3rem;">
                        @if(str_contains(strtolower($categoria->nome), 'pizza'))
                            🍕
                        @elseif(str_contains(strtolower($categoria->nome), 'hambur') || str_contains(strtolower($categoria->nome), 'lanche'))
                            🍔
                        @elseif(str_contains(strtolower($categoria->nome), 'bebida') || str_contains(strtolower($categoria->nome), 'suco'))
                            🥤
                        @elseif(str_contains(strtolower($categoria->nome), 'sobremesa') || str_contains(strtolower($categoria->nome), 'doce'))
                            🍰
                        @elseif(str_contains(strtolower($categoria->nome), 'frango') || str_contains(strtolower($categoria->nome), 'porcao'))
                            🍗
                        @else
                            🍽️
                        @endif
                    </div>
                    <h5 class="card-title mt-2 text-dark">{{ $categoria->nome }}</h5>
                </div>
                {{-- Botões de editar/excluir --}}
                <div class="card-footer bg-transparent border-0 pb-3">
                    <a href="{{ route('categorias.edit', $categoria->id) }}"
                       class="btn btn-warning btn-sm"
                       onclick="event.stopPropagation()">Editar</a>
                    <form action="{{ route('categorias.destroy', $categoria->id) }}"
                          method="POST" class="d-inline"
                          onclick="event.stopPropagation()">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Excluir?')">Excluir</button>
                    </form>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
@endsection