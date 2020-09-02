<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->string('nome_pessoa')->nullable();
            $table->string('natureza_pessoa')->nullable();
            $table->string('tipo_pessoa')->nullable();
            $table->string('tipo_pessoa_id')->nullable();
            $table->string('cpf')->nullable();
            $table->string('rg')->nullable();
            $table->string('orgao_expedidor')->nullable();
            $table->string('id_uf_rg')->nullable();
            $table->string('renach')->nullable();
            $table->string('registro_cnh')->nullable();
            $table->string('data_primeira_habilitacao')->nullable();
            $table->string('data_validade_cnh')->nullable();
            $table->string('uf_cnh_id')->nullable();
            $table->string('sexo')->nullable();
            $table->string('nome_fantasia')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('inscricao_estadual')->nullable();
            $table->string('uf_inscricao_estadual')->nullable();
            $table->string('data_abertura')->nullable();
            $table->string('natureza_juridica')->nullable();
            $table->string('porte_empresa')->nullable();
            $table->string('regime_tributacao')->nullable();
            $table->string('cliente')->nullable();
            $table->string('fornecedor')->nullable();
            $table->string('usuario')->nullable();
            $table->string('funcionario')->nullable();
            $table->string('transportadora')->nullable();
            $table->string('empresa')->nullable();
            $table->integer('user_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoas');
    }
}
