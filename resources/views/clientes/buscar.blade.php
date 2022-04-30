@extends("layout")
@section("conteudo")
    <div class="container">
        <div class="row">
            <div class="col-12 pb-4 pt-4">
                <h1>Clientes</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-12 mb-3">
                <div class="row">
                    <div class="col-6">
                        <h4>Buscar cliente</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-sm-12 col-10">
                <form action="{{ route('buscar_clientes') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group mb-3 col-12 col-md-8">
                            <label>Nome:</label><br>
                            <input type="text" name="nome" id="nome" class="form-control">
                        </div>
                        <div class="form-group mb-3 col-12 col-md-4">
                            <label>CPF ou CNPJ:</label>
                            <input type="text" name="cpf_cnpj" id="cpf_cnpj" class="form-control cpfOuCnpj">
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

    @if(isset($listaClientes) && count($listaClientes) > 0)
        <div class="container">
            <div class="row justify-content-center">
                <div class="table-responsive-lg">
                    <table class="table table-bordered table-hover table-sm" style="min-width: 700px">
                        <thead>
                            <tr>
                                <th>NOME</th>
                                <th>CPF OU CNPJ</th>
                                <th>ENDEREÇO</th>
                                <th>TELEFONE</th>
                                <th>AÇÃO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listaClientes as $cliente)
                                <tr>
                                    <td>{{ $cliente->nome }}</td>
                                    <td>{{ $cliente->cpf_cnpj }}</td>
                                    <td>{{ $cliente->endereco }}</td>
                                    <td>{{ $cliente->tel_contato }}</td>
                                    <td>
                                        <form action="{{ $cliente->id }}" method="post" class="d-inline-block" onsubmit="return confirm('Deseja realmente realizar a exclusão?')">
                                            @csrf
                                            @method('DELETE')
                                            <abbr title="Deletar"><button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button></abbr>
                                        </form>
                                        <abbr title="Editar"><a href="{{ route('clientes_editar', ['id' => $cliente->id]) }}" class="btn btn-sm btn-warning text-white"><i class="fas fa-edit"></i></a></abbr>
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