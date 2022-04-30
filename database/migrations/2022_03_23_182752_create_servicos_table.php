<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicos', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("tipo_servico_id")->unsigned();
            $table->integer("cliente_id")->unsigned();
            $table->integer("funcionario_id")->unsigned();
            $table->date("dt_inicio");
            $table->date("dt_fim");
            $table->decimal("valor_total",10,2);
            $table->decimal("valor_comissao",10,2)->nullable();
            $table->decimal("desconto",10,2)->nullable();
            $table->string("status", 45);
            $table->string("status_pagamento", 45);

            $table->foreign("tipo_servico_id")
                ->references("id")
                ->on("tipo_servico");

            $table->foreign("cliente_id")
                ->references("id")
                ->on("clientes");

            $table->foreign("funcionario_id")
                ->references("id")
                ->on("funcionarios");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicos');
    }
}
