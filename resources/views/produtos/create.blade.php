@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">Novo Produto</div>
            <div class="card-body">
                <form action="{{ route('produtos.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" placeholder="Nome do produto" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descrição</label>
                        <input type="text" name="descricao" class="form-control" placeholder="Descrição">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Preço</label>
                        <input type="number" step="0.01" name="preco" class="form-control" placeholder="0.00" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Estoque</label>
                        <input type="number" name="estoque" class="form-control" placeholder="0" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Salvar</button>
                    <a href="{{ route('produtos.index') }}" class="btn btn-secondary w-100 mt-2">Voltar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection