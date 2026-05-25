<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItensPedido extends Model
{
    protected $fillable = ['pedido_id', 'produto_id', 'quantidade', 'preco_unitario'];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}