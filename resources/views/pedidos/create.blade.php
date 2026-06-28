@extends('layouts.app')

@section('content')
<div class="row">
    {{-- LADO ESQUERDO: Lista de produtos --}}
    <div class="col-md-8">
        <h4 class="fw-bold mb-3">🍔 Escolha seus produtos</h4>

        {{-- Filtro por categoria --}}
        <div class="d-flex gap-2 flex-wrap mb-4">
            <button class="btn btn-sm btn-dark filtro-btn" data-categoria="todos">Todos</button>
            @foreach($categorias as $categoria)
            <button class="btn btn-sm btn-outline-dark filtro-btn" data-categoria="{{ $categoria->id }}">
                @if(str_contains(strtolower($categoria->nome), 'pizza'))🍕
                @elseif(str_contains(strtolower($categoria->nome), 'hambur') || str_contains(strtolower($categoria->nome), 'lanche'))🍔
                @elseif(str_contains(strtolower($categoria->nome), 'bebida'))🥤
                @elseif(str_contains(strtolower($categoria->nome), 'sobremesa'))🍰
                @else🍽️
                @endif
                {{ $categoria->nome }}
            </button>
            @endforeach
        </div>

        {{-- Cards de produtos --}}
        <div class="row row-cols-1 row-cols-md-2 g-3 mb-4">
            @foreach($produtos as $produto)
            <div class="col produto-card" data-categoria="{{ $produto->categoria_id }}">
                <div class="card border-0 shadow-sm h-100">
                    <div class="row g-0 h-100">
                        @if($produto->imagem)
                            <div class="col-4">
                                <img src="{{ asset('storage/' . $produto->imagem) }}"
                                     class="img-fluid rounded-start h-100"
                                     style="object-fit: cover;"
                                     alt="{{ $produto->nome }}">
                            </div>
                        @endif
                        <div class="{{ $produto->imagem ? 'col-8' : 'col-12' }} p-3 d-flex flex-column justify-content-between">
                            <div>
                                <h6 class="fw-bold mb-1">{{ $produto->nome }}</h6>
                                <p class="text-muted small mb-1">{{ $produto->descricao }}</p>
                                <span class="fw-bold text-success">R$ {{ number_format($produto->preco, 2, ',', '.') }}</span>
                            </div>
                            <div class="d-flex align-items-center gap-2 mt-2">
                                <input type="hidden" name="produtos[{{ $loop->index }}][produto_id]" value="{{ $produto->id }}" form="form-pedido">
                                <button type="button" class="btn btn-outline-secondary btn-sm px-2" onclick="decrementar({{ $produto->id }})">−</button>
                                <input type="number" id="qty-{{ $produto->id }}"
                                       name="produtos[{{ $loop->index }}][quantidade]"
                                       class="form-control form-control-sm text-center qty-input"
                                       style="width:60px" min="0" value="0"
                                       form="form-pedido"
                                       data-nome="{{ $produto->nome }}"
                                       data-preco="{{ $produto->preco }}"
                                       onchange="atualizarResumo()">
                                <button type="button" class="btn btn-warning btn-sm px-2" onclick="incrementar({{ $produto->id }})">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- LADO DIREITO: Resumo do pedido --}}
    <div class="col-md-4">
        <div class="card shadow border-0 sticky-top" style="top: 20px;">
            <div class="card-header bg-dark text-white fw-bold">🛒 Resumo do Pedido</div>
            <div class="card-body">
                <div id="resumo-itens">
                    <p class="text-muted text-center small">Nenhum item selecionado</p>
                </div>
                <hr>
                <div class="d-flex justify-content-between fw-bold fs-5">
                    <span>Total:</span>
                    <span class="text-success" id="total-geral">R$ 0,00</span>
                </div>

                <hr>

                {{-- Método de pagamento --}}
                <label class="form-label fw-bold">💳 Pagamento</label>
                <div class="mb-3">
                    <div class="btn-group w-100" role="group">
                        <input type="radio" class="btn-check" name="pagamento" id="dinheiro" value="dinheiro" form="form-pedido" checked>
                        <label class="btn btn-outline-success btn-sm" for="dinheiro">💵 Dinheiro</label>

                        <input type="radio" class="btn-check" name="pagamento" id="cartao" value="cartao" form="form-pedido">
                        <label class="btn btn-outline-primary btn-sm" for="cartao">💳 Cartão</label>

                        <input type="radio" class="btn-check" name="pagamento" id="pix" value="pix" form="form-pedido">
                        <label class="btn btn-outline-warning btn-sm" for="pix">📱 Pix</label>
                    </div>
                </div>

                {{-- Troco (só dinheiro) --}}
                <div id="troco-div" class="mb-3">
                    <label class="form-label small">Troco para quanto?</label>
                    <input type="number" name="troco" id="troco" class="form-control form-control-sm" placeholder="Ex: 50,00" form="form-pedido">
                </div>

                {{-- Parcelas (só cartão) --}}
                <div id="parcelas-div" class="mb-3" style="display:none;">
                    <label class="form-label small">Parcelas</label>
                    <select name="parcelas" class="form-select form-select-sm" form="form-pedido">
                        <option value="1">1x sem juros</option>
                        <option value="2">2x sem juros</option>
                        <option value="3">3x sem juros</option>
                        <option value="4">4x sem juros</option>
                        <option value="5">5x sem juros</option>
                        <option value="6">6x sem juros</option>
                        <option value="7">7x com juros</option>
                        <option value="8">8x com juros</option>
                        <option value="9">9x com juros</option>
                        <option value="10">10x com juros</option>
                        <option value="11">11x com juros</option>
                        <option value="12">12x com juros</option>
                    </select>
                </div>

                <form id="form-pedido" action="{{ route('pedidos.store') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success w-100 fw-bold">
                        ✅ Confirmar Pedido
                    </button>
                </form>
                <a href="{{ route('pedidos.index') }}" class="btn btn-secondary w-100 mt-2">Voltar</a>
            </div>
        </div>
    </div>
</div>

<script>
function incrementar(id) {
    const input = document.getElementById('qty-' + id);
    input.value = parseInt(input.value) + 1;
    atualizarResumo();
}

function decrementar(id) {
    const input = document.getElementById('qty-' + id);
    if (parseInt(input.value) > 0) {
        input.value = parseInt(input.value) - 1;
        atualizarResumo();
    }
}

function atualizarResumo() {
    const inputs = document.querySelectorAll('.qty-input');
    let html = '';
    let total = 0;

    inputs.forEach(input => {
        const qty = parseInt(input.value);
        if (qty > 0) {
            const nome = input.dataset.nome;
            const preco = parseFloat(input.dataset.preco);
            const subtotal = qty * preco;
            total += subtotal;
            html += `<div class="d-flex justify-content-between small mb-1">
                <span>${qty}x ${nome}</span>
                <span>R$ ${subtotal.toFixed(2).replace('.', ',')}</span>
            </div>`;
        }
    });

    document.getElementById('resumo-itens').innerHTML = html || '<p class="text-muted text-center small">Nenhum item selecionado</p>';
    document.getElementById('total-geral').textContent = 'R$ ' + total.toFixed(2).replace('.', ',');
}

// Filtro por categoria
document.querySelectorAll('.filtro-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.filtro-btn').forEach(b => {
            b.classList.remove('btn-dark');
            b.classList.add('btn-outline-dark');
        });
        this.classList.remove('btn-outline-dark');
        this.classList.add('btn-dark');

        const categoria = this.dataset.categoria;
        document.querySelectorAll('.produto-card').forEach(card => {
            if (categoria === 'todos' || card.dataset.categoria == categoria) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
});

// Mostrar/esconder troco e parcelas
document.querySelectorAll('input[name="pagamento"]').forEach(radio => {
    radio.addEventListener('change', function() {
        document.getElementById('troco-div').style.display =
            this.value === 'dinheiro' ? 'block' : 'none';
        document.getElementById('parcelas-div').style.display =
            this.value === 'cartao' ? 'block' : 'none';
    });
});
</script>
@endsection