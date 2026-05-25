@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-warning">Editar Categoria</div>
            <div class="card-body">
                <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" value="{{ $categoria->nome }}" required>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Atualizar</button>
                    <a href="{{ route('categorias.index') }}" class="btn btn-secondary w-100 mt-2">Voltar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection