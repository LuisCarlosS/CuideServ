@extends("layout")
@section("conteudo")
    <div class="container">
        <div class="row">
            <div class="col-12 pb-4 pt-4">
                <h1>Funcionários</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-12 mb-3">
                <div class="row">
                    <div class="col-6">
                        <h4>Buscar funcionários</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-sm-12 col-10">
                <form action="{{ route('buscar_funcionarios') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group mb-3 col-12 col-md-6">
                            <label>Nome:</label><br>
                            <input type="text" name="nome" id="nome" class="form-control">
                        </div>
                        <div class="form-group mb-3 col-12 col-md-3">
                            <label>CPF:</label>
                            <input type="text" name="cpf" id="cpf" data-mask="999.999.999-99" class="form-control">
                        </div>
                        <div class="form-group mb-3 col-12 col-md-3">
                            <label>Status:</label>
                            <select name="status" id="status" class="form-control">
                                <option value=""></option>
                                <option value="Disponivel">Disponível</option>
                                <option value="Ocupado">Ocupado</option>
                                <option value="Afastado">Afastado</option>
                            </select>
                        </div>
                    </div>
                    <input type="submit" value="Buscar" class="btn btn-primary mb-3 float-end">
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 p-4 border-top">
                <div class="row">
                    <div class="col-6">
                        <h5 class="text-secondary">Resultado da busca</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(isset($listaFuncionarios) && count($listaFuncionarios) > 0)
        <div class="container">
            <div class="row justify-content-center">
                <div class="table-responsive-lg">
                    <table class="table table-bordered table-hover table-sm" style="min-width: 700px">
                        <thead>
                            <tr>
                                <th>NOME</th>
                                <th>CPF</th>
                                <th>CELULAR</th>
                                <th>WHATSAPP</th>
                                <th>STATUS</th>
                                <th>AÇÃO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listaFuncionarios as $func)
                                <tr>
                                    <td>{{ $func->nome }}</td>
                                    <td>{{ $func->cpf }}</td>
                                    <td>{{ $func->celular }}</td>
                                    <td>{{ $func->whatsapp }}</td>
                                    <td>{{ $func->status }}</td>
                                    <td>
                                    <form action="{{ $func->idfuncionario }}" method="post" class="d-inline-block" onsubmit="return confirm('Deseja realmente realizar a exclusão?')">
                                                @csrf
                                                @method('DELETE')
                                                <abbr title="Deletar"><button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button></abbr>
                                            </form>
                                        <abbr title="Editar"><a href="{{ route('funcionarios_editar', ['id' => $func->idfuncionario]) }}" class="btn btn-sm btn-warning text-white"><i class="fas fa-edit"></i></a></abbr>
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