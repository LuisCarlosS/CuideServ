<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CuideServ</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header id="header" class="bg-site">
        <div class="container-fluid d-flex justify-content-between bg-dark fixed-top">
            <h1 class="logo"><a href="{{ route('home') }}" class="nav-link">CuideServ</a></h1>

            <nav class="navbar navbar-expand-sm navbar-dark">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('funcionarios') }}" class="nav-link">FUNCIONÁRIOS</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pagamentos') }}" class="nav-link">PAGAMENTOS</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('servicos') }}" class="nav-link">SERVIÇOS</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('clientes') }}" class="nav-link">CLIENTES</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="m-5 p-5 m-sm-4 p-sm-3">

    </div>
    @if(Session::has('success') && Session::get('success') != '')
    <div class="m-2 alert alert-success">
        {{ Session::get('success') }}
    </div>
    @endif

    @if(Session::has('error') && Session::get('error') != '')
    <div class="m-2 alert alert-warning">
        {{ Session::get('error') }}
    </div>
    @endif
    
    @yield("conteudo")
    
    <div class="m-4 p-3">

    </div>
    <footer class="rodape">
        <div class="container-fluid bg-dark fixed-bottom">
            <div class="copyright text-muted text-center p-2">
                &copy; Copyright <strong>Todos os direitos reservados.</strong>
            </div>
        </div>

    </footer>
</body>
<script type="text/javascript" src="{{ asset('js/mascara.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/mask-cpf-cnpj.js') }}"></script>
</html>