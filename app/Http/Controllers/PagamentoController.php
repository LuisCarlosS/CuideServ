<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pagamento;
use App\Models\tipo_servico;

class PagamentoController extends Controller
{
    public function index($id = 0){
        $data = [];
        $p = new pagamento();

        if($id != 0){
            $p = pagamento::find($id);
        }
        $queryPagamento = pagamento::join("tipo_servico", "pagamentos.servico_id", "=", "tipo_servico.id");

        $data["pagamento"] = $p;
        $data["listaTipos"] = tipo_servico::all();
        $data["listaPagamentos"] = $queryPagamento->get(['valor', 'dt_pagamento', 'tipo', 'pagamentos.id as idpagamento']);
        
        return view("pagamentos/index", $data);
    }

    public function salvar(Request $request){
        try{

            $id = $request->input("id", "");

            $p = new pagamento();

            if($id != "" && is_numeric($id)){
                $p = pagamento::find($id);
            }

            $p->fill($request->all());

        $servico = tipo_servico::find($request->input("servico_id"));
        $p->servico()->associate($servico);

        $p->save();

        $request->session()->flash("success", "Pagamento salvo com sucesso!");
        }catch(\Exception $e){
            \Log::error("Erro ao salvar pagamento!", [ $e->getMessage() ]);
            $request->session()->flash("error", "Pagamento não salvo!");
        }

        return back();
    }
    public function excluir($id, Request $request){
        pagamento::findOrFail($id)->delete();

        if($id == null){
            $request->session()->flash("error", "Não foi possível excluir o pagamento!");
            return back();
        }
        $request->session()->flash("success", "Pagamento excluído com sucesso!");

        return back();
    }
}
