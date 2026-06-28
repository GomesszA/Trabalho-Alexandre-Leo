<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * MODEL - Representa a tabela 'produtos' no banco de dados.
 */
class Produto extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'estoque',
        'categoria_id',
        'imagem',
    ];

    /**
     * Relacionamento: produto pertence a uma categoria
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}