@extends("layout")
@section("conteudo")
    <div class="container">
        <div class="row">
            <div class="col-12 pb-4 pt-4">
                <h1>Serviços</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-12 mb-3">
                <div class="row">
                    <div class="col-6">
                        <h4>Dados do Serviço</h4>
                    </div>
                    <div class="col-6">
                        <a class="btn btn-success float-end" href="{{ route('tipos_servicos') }}" role="button">Tipos de serviços</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-sm-12 col-10">
                <form action="{{ route('servicos_salvar') }}" method="post">
                    <input type="hidden" name="id" id="id" value="{{ $servico->id}}">
                    @csrf
                    <div class="row">
                        <div class="form-group mb-3 col-12 col-md-4">
                            <label>Tipo de serviço:</label><br>
                            <select name="tipo_servico_id" id="tipo_servico_id" class="form-control desfoque">
                                <option value=""></option>
                                @if(isset($listaTipos))
                                    @foreach($listaTipos as $tipo_servico)
                                    <option value="{{ $tipo_servico->id }}" data-id="{{ $tipo_servico->valor_servico }}" data-com="{{ $tipo_servico->valor_comissao }}" @if($tipo_servico->id == $servico->tipo_servico_id) selected @endif>{{ $tipo_servico->tipo }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group mb-3 col-12 col-md-4">
                            <label>Cliente:</label><br>
                            <select name="cliente_id" id="cliente_id" class="form-control">
                            <option value=""></option>
                                @if(isset($listaClientes))
                                    @foreach($listaClientes as $cliente)
                                    <option value="{{ $cliente->id }}" @if($cliente->id == $servico->cliente_id) selected @endif>{{ $cliente->nome }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group mb-3 col-12 col-md-4">
                            <label>Funcionário:</label>
                            <select name="funcionario_id" id="funcionario_id" class="form-control">
                            <option value=""></option>
                                @if(isset($listaFuncionarios))
                                    @foreach($listaFuncionarios as $funcionario)
                                    <option value="{{ $funcionario->id }}" @if($funcionario->id == $servico->funcionario_id) selected @endif>{{ $funcionario->nome }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group mb-3 col-12 col-md-3">
                            <label>Data início:</label>
                            <input type="date" name="dt_inicio" id="dt_inicio" class="form-control" value="{{ $servico->dt_inicio }}">
                        </div>
                        <div class="form-group mb-3 col-12 col-md-3">
                            <label>Data fim:</label><br>
                            <input type="date" name="dt_fim" id="dt_fim" class="form-control" value="{{ $servico->dt_fim }}">
                        </div>
                        <div class="form-group mb-3 col-12 col-md-3">
                            <label>Valor total:</label>
                            <input type="text" name="valor_total" id="valor_total" class="form-control" value="{{ $servico->valor_total }}" readonly>
                        </div>
                        <div class="form-group mb-3 col-12 col-md-3">
                            <label>Valor da comissão:</label>
                            <input type="text" name="valor_comissao" id="valor_comissao" class="form-control"  value="{{ $servico->valor_comissao }}" readonly>
                        </div>
                        <div class="form-group mb-3 col-12 col-md-4">
                            <label>Desconto:</label><br>
                            <input type="text" name="desconto" id="desconto" class="form-control"  value="{{ $servico->desconto }}">
                        </div>
                        <div class="form-group mb-3 col-12 col-md-4">
                            <label>Status:</label>
                            <select name="status" id="status" class="form-control">
                                <option value="" value="{{ $servico->status }}"></option>
                                <option value="agendado" <?php echo $servico->status == 'agendado'?'selected':'';?>>Agendado</option>
                                <option value="concluido" <?php echo $servico->status == 'concluido'?'selected':'';?>>Concluido</option>
                                <option value="cancelado" <?php echo $servico->status == 'cancelado'?'selected':'';?>>Cancelado</option>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-12 col-md-4">
                            <label>Status de pagamento:</label>
                            <select name="status_pagamento" id="status_pagamento" class="form-control">
                                <option value=""></option>
                                <option value="aguardando" <?php echo $servico->status_pagamento == 'aguardando'?'selected':'';?>>Aguardando</option>
                                <option value="pago" <?php echo $servico->status_pagamento == 'pago'?'selected':'';?>>Pago</option>
                            </select>
                        </div>
                    </div>
                    <input type="submit" value="Salvar" class="btn btn-primary mb-3 float-end">
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 p-4 border-top">
                <div class="row">
                    <div class="col-6">
                        <h5 class="text-secondary">Serviços</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(isset($listaServicos) && count($listaServicos) > 0)
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="table-responsive-xxl">
                    <table class="table table-bordered table-hover table-sm" style="min-width: 1400px">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>TIPO DE SERVIÇO</th>
                                <th>CLIENTE</th>
                                <th>FUNCIONÁRIO</th>
                                <th>DATA INÍCIO</th>
                                <th>DATA FIM</th>
                                <th>VALOR TOTAL</th>
                                <th>VALOR DA COMISSÃO</th>
                                <th>DESCONTO</th>
                                <th>STATUS</th>
                                <th>STATUS DE PAGAMENTO</th>
                                <th>AÇÃO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listaServicos as $serv)
                                <tr>
                                    <td>{{ $serv->idservico }}</td>
                                    <td>{{ $serv->nometipo_servico }}</td>
                                    <td>{{ $serv->nomecliente }}</td>
                                    <td>{{ $serv->nomefuncionario }}</td>
                                    <td>{{ $serv->getDtInicioView() }}</td>
                                    <td>{{ $serv->getDtFimView() }}</td>
                                    <td>R$ {{ $serv->valor_total }}</td>
                                    <td>R$ {{ $serv->valor_comissao_servico }}</td>
                                    <td>R$ {{ $serv->desconto }}</td>
                                    <td>{{ $serv->status_servico }}</td>
                                    <td>{{ $serv->status_pagamento }}</td>
                                    <td>
                                        <form action="{{ route('servicos_excluir', ['id' =>$serv->idservico]) }}" method="post" class="d-inline-block" onsubmit="return confirm('Deseja realmente realizar a exclusão?')">
                                            @csrf
                                            @method('DELETE')
                                            <abbr title="Deletar"><button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button></abbr>
                                        </form>
                                        <abbr title="Editar"><a href="{{ route('servicos_editar', ['id' => $serv->idservico]) }}" class="btn btn-sm btn-warning text-white"><i class="fas fa-edit"></i></a></abbr>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

<script>
    const inputtipo_servico_id = document.querySelector("#tipo_servico_id")
    const inputvalor_total = document.querySelector('#valor_total')
  
    const evento = document.querySelectorAll(".desfoque")
    evento.forEach(
        desfoque => desfoque.addEventListener("change", (event) => {
        let index = inputtipo_servico_id.selectedIndex
        const valorServico = inputtipo_servico_id.options[index].getAttribute("data-id")
        let tipo_servico_id = inputtipo_servico_id.value
        if (tipo_servico_id != "") {
            inputvalor_total.value = valorServico
        }
    }))
</script>

<script>
    const inputtipo_servico = document.querySelector("#tipo_servico_id")
    const inputvalor_comissao = document.querySelector('#valor_comissao')
  
    const caso = document.querySelectorAll(".desfoque")
    caso.forEach(
        desfoque => desfoque.addEventListener("change", (event) => {
        let index = inputtipo_servico.selectedIndex
        const valorComissao = inputtipo_servico.options[index].getAttribute("data-com")
        let tipo_servico_id = inputtipo_servico.value
        if (tipo_servico_id != "") {
            inputvalor_comissao.value = valorComissao
        }
    }))
</script>

@endsection