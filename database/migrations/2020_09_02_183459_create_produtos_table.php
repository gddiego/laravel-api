<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('descricao')->nullable();
            $table->foreign('sub_categoria_id')
                ->references('id')
                ->on('sub_categorias')
                ->onDelete('cascade');
            $table->string('codigo_ean')->nullable();
            $table->foreign('tipo_id')
                ->references('id')
                ->on('tipos')
                ->onDelete('cascade');
            $table->string('estoque_minimo')->nullable();
            $table->string('data_ultima_entrada')->nullable();
            $table->string('data_ultima_saida')->nullable();
            $table->string('situacao')->nullable();
            $table->string('fracao_controle')->nullable();
            $table->string('preco_custo')->nullable();
            $table->string('preco_venda')->nullable();
            $table->string('preco_ultima_entrada')->nullable();
            $table->foreign('unidade_id')
                ->references('id')
                ->on('unidades')
                ->onDelete('cascade');
            $table->foreign('categoria_id')
                ->references('id')
                ->on('categorias')
                ->onDelete('cascade');
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
        Schema::dropIfExists('produtos');
    }
}
