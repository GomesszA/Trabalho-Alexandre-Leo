@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">Novo Pedido</div>
            <div class="card-body">
                <form action="{{ route('pedidos.store') }}" method="POST">
                    @csrf
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produtos as $produto)
                            <tr>
                                <td>{{ $produto->nome }}</td>
                                <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                                <td>
                                    <input type="hidden" name="produtos[{{ $loop->index }}][produto_id]" value="{{ $produto->id }}">
                                    <input type="number" name="produtos[{{ $loop->index }}][quantidade]" class="form-control" style="width:80px" min="0" value="0">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success w-100">Salvar Pedido</button>
                    <a href="{{ route('pedidos.index') }}" class="btn btn-secondary w-100 mt-2">Voltar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection