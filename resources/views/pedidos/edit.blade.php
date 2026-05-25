@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-warning">Editar Pedido #{{ $pedido->id }}</div>
            <div class="card-body">
                <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="aberto" {{ $pedido->status == 'aberto' ? 'selected' : '' }}>Aberto</option>
                            <option value="fechado" {{ $pedido->status == 'fechado' ? 'selected' : '' }}>Fechado</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Atualizar</button>
                    <a href="{{ route('pedidos.index') }}" class="btn btn-secondary w-100 mt-2">Voltar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection