<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\funcionario;

class FuncionarioController extends Controller
{
    public function index($id = 0){
        $data = [];
        $f = new funcionario();

        if($id != 0){
            $f = funcionario::find($id);
        }

        $data["func"] = $f;
        return view("funcionarios/index", $data);
    }

    public function salvar(Request $request){
        try{
        
            $id = $request->input("id", "");

            $f = new funcionario();

            if($id != "" && is_numeric($id)){
                $f = funcionario::find($id);
            }

            $f->fill($request->all());

            $f->save();

            $request->session()->flash("success", "Funcionário salvo com sucesso!");
        }catch(\Exception $e){
            \Log::error("Erro ao cadastrar funcionário!", [ $e->getMessage() ]);
            $request->session()->flash("error", "Funcionário não salvo!");
        }
        return back();
    }

    public function buscar(Request $request){
    $data = [];

        if($request->isMethod("post")){
            $nome = $request->input("nome");
            $cpf = $request->input("cpf");
            $status = $request->input("status");

            $queryfuncionario = new funcionario();
            if($nome != ""){
                $queryfuncionario = $queryfuncionario->where("nome", "like", $nome . "%");
            }

            if($cpf != ""){
                $queryfuncionario = $queryfuncionario->where("cpf", "=", $cpf);
            }
            
            if($status != ""){
                $queryfuncionario = $queryfuncionario->where("status", "=", $status);
            }

            $queryfuncionario = $queryfuncionario->orderBy("funcionarios.nome");
            $data["listaFuncionarios"] = $queryfuncionario->get(['nome', 'cpf', 'celular', 'whatsapp', 'status', 'funcionarios.id as idfuncionario']);
        }

        return view("funcionarios/buscar", $data);
    }

    public function excluir($id, Request $request){

        funcionario::findOrFail($id)->delete();

        if($id == null){
            $request->session()->flash("error", "Não foi possível excluir o funcionário!");
            return back();
        }
        
        $request->session()->flash("success", "Funcionário excluído com sucesso!");
        return back();
    }
}
