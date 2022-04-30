<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\servico;
use App\Models\tipo_servico;
use App\Models\cliente;
use App\Models\funcionario;

class ServicoController extends Controller
{
    public function index($id = 0){
        $data = [];
        $s = new servico();

        if($id != 0){
            $s = servico::find($id);
        }
        $queryServico = servico::join("tipo_servico", "servicos.tipo_servico_id", "=", "tipo_servico.id")
                                ->join("clientes", "servicos.cliente_id", "=", "clientes.id")
                                ->join("funcionarios", "servicos.funcionario_id", "=", "funcionarios.id");

        $data["servico"] = $s;
        $data["listaTipos"] = tipo_servico::all();
        $data["listaClientes"] = cliente::all();
        $data["listaFuncionarios"] = funcionario::all();
        $data["listaServicos"] = $queryServico->get(['servicos.id as idservico', 'tipo_servico.id as idtipo_servico', 'tipo_servico.tipo as nometipo_servico', 'clientes.id as idcliente', 'clientes.nome as nomecliente', 'funcionarios.nome as nomefuncionario', 'funcionarios.id as idfuncionario', 'dt_inicio', 'dt_fim', 'valor_total', 'servicos.valor_comissao as valor_comissao_servico', 'desconto', 'servicos.status as status_servico', 'status_pagamento']);
        
        return view("servicos/index", $data);
    }

    public function salvar(Request $request){
        try{

            $id = $request->input("id", "");

            $s = new servico();

            if($id != "" && is_numeric($id)){
                $s = servico::find($id);
            }

            $s->fill($request->all());

            $tipo_servico = tipo_servico::find($request->input("tipo_servico_id"));
            $s->tipo_servico()->associate($tipo_servico);

            $cliente = cliente::find($request->input("cliente_id"));
            $s->cliente()->associate($cliente);
            
            $funcionario = funcionario::find($request->input("funcionario_id"));
            $s->funcionario()->associate($funcionario);

            $s->save();

            $request->session()->flash("success", "Serviço salvo com sucesso!");
        }catch(\Exception $e){
            \Log::error("Erro ao salvar serviço!", [ $e->getMessage() ]);
            $request->session()->flash("error", "Serviço não salvo!");
        }
        return back();
    }
    
    public function tipos($id = 0){
        $data = [];
        $t = new tipo_servico();

        if($id != 0){
            $t = tipo_servico::find($id);
        }
        
        $data["tipo_servico"] = $t;
        $data["listaTipos"] = $t->get(['id', 'tipo', 'valor_servico', 'valor_comissao']);
        return view("servicos/tipos_servicos", $data);
    }

    public function tipos_salvar(Request $request){
        try{

            $id = $request->input("id", "");

            $t = new tipo_servico();

            if($id != "" && is_numeric($id)){
                $t = tipo_servico::find($id);
            }

            $t->fill($request->all());

            $t->save();
    
            $request->session()->flash("success", "Tipo de serviço salvo com sucesso!");
            }catch(\Exception $e){
                \Log::error("Erro ao salvar tipo de serviço!", [ $e->getMessage() ]);
                $request->session()->flash("error", "Tipo de serviço não salvo!");
            }
            return back();
    }

    public function excluir($id, Request $request){
        servico::findOrFail($id)->delete();

        if($id == null){
            $request->session()->flash("error", "Não foi possível excluir o serviço!");
            return back();
        }
        $request->session()->flash("success", "Serviço excluído com sucesso!");

        return back();
    }

    public function tipos_excluir($id, Request $request){
        tipo_servico::findOrFail($id)->delete();

        if($id == null){
            $request->session()->flash("error", "Não foi possível excluir o tipo de serviço!");
            return back();
        }
        $request->session()->flash("success", "Tipo de serviço excluído com sucesso!");

        return back();
    }
}
