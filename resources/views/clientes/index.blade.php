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
                        <h4>Cadastrar clientes</h4>
                    </div>
                    <div class="col-6">
                        <a class="btn btn-success float-end" href="{{ route('buscar_clientes') }}" role="button">Buscar clientes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-sm-12 col-10">
                <form action="{{ route('clientes_salvar') }}" method="post">
                    <input type="hidden" name="id" value="{{ $cliente->id}}">
                    @csrf
                    <div class="row">
                        <div class="form-group mb-3 col-12 col-md-8">
                            <label>Nome:</label><br>
                            <input type="text" name="nome" id="nome" class="form-control" value="{{ $cliente->nome }}">
                        </div>
                        <div class="form-group mb-3 col-12 col-md-4">
                            <label>CPF ou CNPJ:</label>
                            <input type="text" name="cpf_cnpj" id="cpf_cnpj" class="form-control" value="{{ $cliente->cpf_cnpj }}">
                        </div>
                        <div class="form-group mb-3 col-12 col-md-8">
                            <label>Endereço:</label>
                            <input type="text" name="endereco" id="endereco" class="form-control" value="{{ $cliente->endereco }}">
                        </div>
                        <div class="form-group mb-3 col-12 col-md-4">
                            <label>Telefone:</label>
                            <input type="text" name="tel_contato" id="tel_contato" data-mask="(99)9999-9999"class="form-control" value="{{ $cliente->tel_contato }}">
                        </div>
                    </div>
                    <input type="submit" value="Salvar" class="btn btn-primary float-end">
                </form>
            </div>
        </div>
    </div>
@endsection