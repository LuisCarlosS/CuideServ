<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cliente;
use Illuminate\Console\Scheduling\Event;

class ClienteController extends Controller
{
    public function index($id = 0){
        $data = [];
        $c = new cliente();

        if($id != 0){
            $c = cliente::find($id);
        }

        $data["cliente"] = $c;
        return view("clientes/index", $data);
    }

    public function salvar(Request $request){
        try{
            $id = $request->input("id", "");

            $c = new cliente();

            if($id != "" && is_numeric($id)){
                $c = cliente::find($id);
            }

            $c->fill($request->all());

            $c->save();

            $request->session()->flash("success", "Cliente salvo com sucesso!");
        }catch (\Exception $e){
            \Log::error("Erro ao salvar cliente!", [ $e->getMessage() ]);
            $request->session()->flash("error", "Cliente não salvo!");
        }
        return back();
    }

    public function buscar(Request $request){
        $data = [];
    
            if($request->isMethod("post")){
                $nome = $request->input("nome");
                $cpf_cnpj = $request->input("cpf_cnpj");
    
                $querycliente = new cliente();
                if($nome != ""){
                    $querycliente = $querycliente->where("nome", "like", $nome . "%");
                }
    
                if($cpf_cnpj != ""){
                    $querycliente = $querycliente->where("cpf_cnpj", "=", $cpf_cnpj);
                }
                
                $querycliente = $querycliente->orderBy("clientes.nome");
                $data["listaClientes"] = $querycliente->get(['id','nome', 'cpf_cnpj', 'endereco', 'tel_contato']);
            }
    
            return view("clientes/buscar", $data);
        }

        public function excluir($id, Request $request){

            cliente::findOrFail($id)->delete();

            if($id == null){
                $request->session()->flash("error", "Não foi possível excluir o cliente!");
                return back();
            }
            
            $request->session()->flash("success", "Cliente excluído com sucesso!");
            return back();
        }
}
