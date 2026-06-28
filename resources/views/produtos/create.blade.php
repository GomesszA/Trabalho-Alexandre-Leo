@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Novo Produto</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') }}">
                        @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descrição</label>
                        <textarea name="descricao" class="form-control @error('descricao') is-invalid @enderror" rows="3">{{ old('descricao') }}</textarea>
                        @error('descricao') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Preço (R$)</label>
                            <input type="number" name="preco" step="0.01" min="0" class="form-control @error('preco') is-invalid @enderror" value="{{ old('preco') }}">
                            @error('preco') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Estoque</label>
                            <input type="number" name="estoque" min="0" class="form-control @error('estoque') is-invalid @enderror" value="{{ old('estoque') }}">
                            @error('estoque') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Categoria</label>
                        <select name="categoria_id" class="form-select @error('categoria_id') is-invalid @enderror">
                            <option value="">Sem categoria</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('categoria_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Imagem do Produto</label>
                        <input type="file" name="imagem" class="form-control @error('imagem') is-invalid @enderror" accept="image/*">
                        @error('imagem') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Salvar Produto</button>
                        <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection