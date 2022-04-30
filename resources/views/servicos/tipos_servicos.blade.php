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
                        <h4>Dados do tipo de serviço</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-sm-12 col-10">
                <form action="{{ route('tipos_servicos_salvar') }}" method="post">
                    <input type="hidden" name="id" id="id" value="{{ $tipo_servico->id}}">
                    @csrf
                    <div class="row">
                        <div class="form-group mb-3 mb-3 col-12 col-md-6">
                            <label>Tipo:</label><br>
                            <input type="text" name="tipo" id="tipo" class="form-control" value="{{ $tipo_servico->tipo }}">
                        </div>
                        <div class="form-group mb-3 mb-3 col-12 col-md-3">
                            <label>Valor do serviço:</label>
                            <input type="text" name="valor_servico" id="valor_servico" class="form-control" value="{{ $tipo_servico->valor_servico }}">
                        </div>
                        <div class="form-group mb-3 mb-3 col-12 col-md-3">
                            <label>Valor da comissão:</label>
                            <input type="text" name="valor_comissao" id="valor_comissao" class="form-control" value="{{ $tipo_servico->valor_comissao }}">
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
                        <h5 class="text-secondary">Tipos de serviço</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(isset($listaTipos) && count($listaTipos) > 0)
        <div class="container">
            <div class="row justify-content-center">
                <div class="table-responsive-lg">
                    <table class="table table-bordered table-hover table-sm" style="min-width: 700px">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>TIPO DE SERVIÇO</th>
                                <th>VALOR DO SERVIÇO</th>
                                <th>VALOR DA COMISSÃO</th>
                                <th>AÇÃO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listaTipos as $tipo)
                                <tr>
                                    <td>{{ $tipo->id }}</td>
                                    <td>{{ $tipo->tipo }}</td>
                                    <td>R$ {{ $tipo->valor_servico }}</td>
                                    <td>R$ {{ $tipo->valor_comissao }}</td>
                                    <td>
                                        <form action="{{ route('tipos_servicos_excluir', ['id' => $tipo->id]) }}" method="post" class="d-inline-block" onsubmit="return confirm('Deseja realmente realizar a exclusão?')">
                                            @csrf
                                            @method('DELETE')
                                            <abbr title="Deletar"><button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button></abbr>
                                        </form>
                                        <abbr title="Editar"><a href="{{ route('tipos_servicos_editar', ['id' => $tipo->id]) }}" class="btn btn-sm btn-warning text-white"><i class="fas fa-edit"></i></a></abbr>
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