<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaFormRequest;
use App\Pessoa;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class PessoaController extends Controller
{


    /**
     * @var
     */
    protected $user;

    /**
     * TaskController constructor.
     */
    public function __construct()
    {
        // $this->user = JWT::parseToken()->authenticate();
    }

    public function index()
    {
        $pessoas = Pessoa::all();

        return $pessoas;
    }


    public function show($id)
    {
        $pessoa = Pessoa::find($id);

        if (!$pessoa) {
            return response()->json([
                'success' => false,
                'message' => 'Ops, não foi encontrado o id  ' . $id . ' não pode ser encontrado.'
            ], 400);
        }



        return $pessoa;
    }

    /**
     * @param RegistrationFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PessoaFormRequest  $request)
    {

        $pessoa = new Pessoa();
        $pessoa->user_id = $request->user_id;
        $pessoa->nome_pessoa = $request->nome_pessoa;
        $pessoa->natureza_pessoa = $request->natureza_pessoa;
        $pessoa->tipo_pessoa = $request->tipo_pessoa;
        $pessoa->tipo_pessoa_id = $request->tipo_pessoa_id;
        $pessoa->cpf = $request->cpf;
        $pessoa->rg = $request->rg;
        $pessoa->orgao_expedidor = $request->orgao_expedidor;
        $pessoa->id_uf_rg = $request->id_uf_rg;
        $pessoa->renach = $request->renach;
        $pessoa->registro_cnh = $request->registro_cnh;
        $pessoa->data_primeira_habilitacao = $request->data_primeira_habilitacao;
        $pessoa->data_validade_cnh = $request->data_validade_cnh;
        $pessoa->uf_cnh_id = $request->uf_cnh_id;
        $pessoa->sexo = $request->sexo;
        $pessoa->nome_fantasia = $request->nome_fantasia;
        $pessoa->cnpj = $request->cnpj;
        $pessoa->inscricao_estadual = $request->inscricao_estadual;
        $pessoa->uf_inscricao_estadual = $request->uf_inscricao_estadual;
        $pessoa->data_abertura = $request->data_abertura;
        $pessoa->natureza_juridica = $request->natureza_juridica;
        $pessoa->porte_empresa = $request->porte_empresa;
        $pessoa->regime_tributacao = $request->regime_tributacao;
        $pessoa->porte_empresa = $request->porte_empresa;
        $pessoa->cliente = $request->cliente;
        $pessoa->fornecedor = $request->fornecedor;
        $pessoa->usuario = $request->usuario;
        $pessoa->funcionario = $request->funcionario;
        $pessoa->transportadora = $request->transportadora;
        $pessoa->empresa = $request->empresa;

        if ($pessoa->save())
            return response()->json([
                'success' => true,
                'Pessoa' => $pessoa
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Ops, task não foi possivel cadastrar novo registro.'
            ], 500);
    }

    public function update(PessoaFormRequest $request, $id)
    {
        $pessoa = Pessoa::find($id);

        if (!$pessoa) {
            return response()->json([
                'success' => false,
                'message' => 'Ops, não foi encontrado id ' . $id . ' não pode ser encontrado.'
            ], 400);
        }

        $updated = $pessoa->fill($request->all())->save();

        if ($updated) {
            return response()->json([
                'data' => $pessoa,
                'success' => true,
                'message' => 'Alteração feito com sucesso.'

            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Ops, registro não foi atualizado.'
            ], 500);
        }
    }

    public function destroy($id)
    {
        $pessoa = Pessoa::find($id);

        if (!$pessoa) {
            return response()->json([
                'success' => false,
                'message' => 'Ops, não foi encontrado id ' . $id . ' não pode ser encontrado.'
            ], 400);
        }

        if ($pessoa->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Registro deletado com sucesso'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Registro não encontrado para ser removido'
            ], 500);
        }
    }
}
