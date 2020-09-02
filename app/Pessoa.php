<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pessoa extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'nome_pessoa', 'natureza_pessoa',
        'tipo_pessoa', 'tipo_pessoa_id', 'cpf',
        'rg', 'orgao_expedidor', 'id_uf_rg',
        'renach', 'registro_cnh', 'data_primeira_habilitacao',
        'data_validade_cnh', 'uf_cnh_id', 'sexo',
        'nome_fantasia', 'cnpj', 'inscricao_estadual',
        'uf_inscricao_estadual', 'data_abertura', 'natureza_juridica',
        'porte_empresa', 'regime_tributacao', 'cliente',
        'fornecedor', 'usuario', 'funcionario',
        'transportadora', 'empresa',

    ];
}
