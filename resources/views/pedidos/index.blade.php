@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Pedidos</h2>
    <a href="{{ route('pedidos.create') }}" class="btn btn-success">+ Novo Pedido</a>
</div>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Status</th>
            <th>Total</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pedidos as $pedido)
        <tr>
            <td>{{ $pedido->id }}</td>
            <td>
                <span class="badge {{ $pedido->status == 'aberto' ? 'bg-success' : 'bg-secondary' }}">
                    {{ ucfirst($pedido->status) }}
                </span>
            </td>
            <td>R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
            <td>
                <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Excluir?')">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection