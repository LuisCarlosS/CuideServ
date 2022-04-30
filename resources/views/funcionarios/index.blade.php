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
                        <h4>Dados do funcionário</h4>
                    </div>
                    <div class="col-6">
                        <a class="btn btn-success float-end" href="{{ route('buscar_funcionarios') }}" role="button">Buscar funcionário</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-sm-12 col-10">
                <form action="{{ route('funcionarios_salvar') }}" method="post">
                    <input type="hidden" name="id" value="{{ $func->id}}">
                    @csrf
                    <div class="row">
                        <div class="form-group mb-3 col-12 col-sm-7">
                            <label>Nome:</label><br>
                            <input type="text" name="nome" id="nome" class="form-control" value="{{ $func->nome }}">
                        </div>
                        <div class="form-group mb-3 col-12 col-sm-5">
                            <label>CPF:</label>
                            <input type="text" name="cpf" id="cpf" data-mask="999.999.999-99" class="form-control" value="{{ $func->cpf }}">
                        </div>
                        <div class="form-group mb-3 col-12 col-sm-4">
                            <label>Celular:</label>
                            <input type="text"  name="celular" id="celular" data-mask="(99)99999-9999" class="form-control" value="{{ $func->celular }}">
                        </div>
                        <div class="form-group mb-3 col-12 col-sm-4">
                            <label>Whatsapp:</label>
                            <input type="text"  name="whatsapp" id="whatsapp" data-mask="(99)99999-9999" class="form-control" value="{{ $func->whatsapp }}">
                        </div>
                        <div class="form-group mb-3 col-12 col-sm-4">
                            <label>Status:</label>
                            <select name="status" id="status" class="form-control">
                                <option value=""></option>
                                <option value="Disponivel" <?php echo $func->status == 'Disponivel'?'selected':'';?>>Disponível</option>
                                <option value="Ocupado" <?php echo $func->status == 'Ocupado'?'selected':'';?>>Ocupado</option>
                                <option value="Afastado" <?php echo $func->status == 'Afastado'?'selected':'';?>>Afastado</option>
                            </select>
                        </div>
                    </div>
                    <input type="submit" value="Salvar" class="btn btn-primary float-end">
                </form>
            </div>
        </div>
    </div>
@endsection