@extends("layout")
@section("conteudo")
    <div class="container">
        <div class="row">
            <div class="col-12 pb-4 pt-4">
                <h1>Pagamentos</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-12 mb-3">
                <div class="row">
                    <div class="col-6">
                        <h4>Dados do pagamento</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-sm-12 col-10">
                <form action="{{ route('pagamentos_salvar') }}" method="post">
                    <input type="hidden" name="id" id="id" value="{{ $pagamento->id}}">
                    @csrf
                    <div class="row">
                        <div class="form-group mb-3 col-12 col-md-4">
                            <label>Valor:</label><br>
                            <input type="text" name="valor" id="valor" class="form-control" value="{{ $pagamento->valor }}">
                        </div>
                        <div class="form-group mb-3 col-12 col-md-4">
                            <label>Data do recebimento:</label>
                            <input type="date" name="dt_pagamento" id="dt_pagamento" class="form-control" value="{{ $pagamento->dt_pagamento }}">
                        </div>
                        <div class="form-group mb-3 col-12 col-md-4">
                            <label>Serviço:</label>
                            <select name="servico_id" id="servico_id" class="form-control">
                                <option value=""></option>
                                @if(isset($listaTipos))
                                    @foreach($listaTipos as $tipo_servico)
                                    <option value="{{ $tipo_servico->id }}" @if($tipo_servico->id == $pagamento->servico_id) selected @endif>{{ $tipo_servico->tipo }}</option>
                                    @endforeach
                                @endif
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
                        <h5 class="text-secondary">Histórico</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(isset($listaPagamentos) && count($listaPagamentos) > 0)
        <div class="container">
            <div class="row justify-content-center">
                <div class="table-responsive-lg">
                    <table class="table table-bordered table-hover table-sm" style="min-width: 700px">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>VALOR</th>
                                <th>DATA DO RECEBIMENTO</th>
                                <th>SERVIÇO</th>
                                <th>AÇÃO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listaPagamentos as $pag)
                                <tr>
                                    <td>{{ $pag->idpagamento }}</td>
                                    <td>R$ {{ $pag->valor }}</td>
                                    <td>{{ $pag->getDtPagamentoView() }}</td>
                                    <td>{{ $pag->tipo }}</td>
                                    <td>
                                        <form action="{{ route('pagamentos_excluir', ['id' => $pag->idpagamento]) }}" method="post" class="d-inline-block" onsubmit="return confirm('Deseja realmente realizar a exclusão?')">
                                            @csrf
                                            @method('DELETE')
                                            <abbr title="Deletar"><button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button></abbr>
                                        </form>
                                        <abbr title="Editar"><a href="{{ route('pagamentos_editar', ['id' => $pag->idpagamento]) }}" class="btn btn-sm btn-warning text-white"><i class="fas fa-edit"></i></a></abbr>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection