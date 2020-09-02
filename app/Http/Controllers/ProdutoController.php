<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{

    public function index()
    {
        $produtos = Produto::all();

        return $produtos;
    }


    public function show($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json([
                'success' => false,
                'message' => 'Ops, não foi encontrado o id  ' . $id . ' não pode ser encontrado.'
            ], 400);
        }



        return $produto;
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'nome_pessoa' => 'required',
            'natureza_pessoa' => 'required',
            'cpf' => 'required',
        ]);

        $produto = new Produto();
        $produto->descricao = $request->descricao;
        $produto->sub_categoria_id = $request->sub_categoria_id;
        $produto->codigo_ean = $request->codigo_ean;
        $produto->tipo_id = $request->tipo_id;
        $produto->data_ultima_entrada = $request->data_ultima_entrada;
        $produto->data_ultima_saida = $request->data_ultima_saida;
        $produto->situacao = $request->situacao;
        $produto->fracao_controle = $request->fracao_controle;
        $produto->preco_custo = $request->preco_custo;
        $produto->preco_venda = $request->preco_venda;
        $produto->preco_ultima_entrada = $request->preco_ultima_entrada;
        $produto->unidade_id = $request->unidade_id;
        $produto->categoria_id = $request->categoria_id;

        if ($produto->save())
            return response()->json([
                'success' => true,
                'Pessoa' => $produto
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Ops, task não foi possivel cadastrar novo registro.'
            ], 500);
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json([
                'success' => false,
                'message' => 'Ops, não foi encontrado id ' . $id . ' não pode ser encontrado.'
            ], 400);
        }

        $updated = $produto->fill($request->all())->save();

        if ($updated) {
            return response()->json([
                'data' => $produto,
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
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json([
                'success' => false,
                'message' => 'Ops, não foi encontrado id ' . $id . ' não pode ser encontrado.'
            ], 400);
        }

        if ($produto->delete()) {
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
