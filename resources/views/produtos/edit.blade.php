@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-warning">Editar Produto</div>
            <div class="card-body">
                <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" value="{{ $produto->nome }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descrição</label>
                        <input type="text" name="descricao" class="form-control" value="{{ $produto->descricao }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Preço</label>
                        <input type="number" step="0.01" name="preco" class="form-control" value="{{ $produto->preco }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Estoque</label>
                        <input type="number" name="estoque" class="form-control" value="{{ $produto->estoque }}" required>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Atualizar</button>
                    <a href="{{ route('produtos.index') }}" class="btn btn-secondary w-100 mt-2">Voltar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection