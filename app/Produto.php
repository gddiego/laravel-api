<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Produto extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descricao', 'sub_categoria_id', 'codigo_ean',
        'tipo_id', 'estoque_minimo', 'data_ultima_entrada',
        'data_ultima_saida', 'situacao', 'fracao_controle',
        'preco_custo', 'preco_venda', 'preco_ultima_entrada',
        'unidade_id',
        'categoria_id',
    ];
}
