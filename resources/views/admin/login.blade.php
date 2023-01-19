<!doctype html>
<html class="no-js" lang=""> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GSB - Login</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href={{ asset('images/logo.png') }}>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href={{ asset('css/cs-skin-elastic.css')}} >
    <link rel="stylesheet" href={{ asset('css/style.css') }}>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body class="bg-dark">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-form">
                    <div class="login-logo">
                        <a href="index.html">
                            <img class="align-content" src={{ asset('images/logo.png') }} alt=""> <span>G</span>estor de
                            <span>S</span>alão de
                            <span>B</span>eleza
                        </a>
                        <!-- <h4 class="text-bold logo-text"> <span>G</span>estor de <span>S</span>alão de
                            <span>B</span>eleza
                        </h4> -->
                        @if (session()->get('errorMsg'))
                        {{ session()->get('errorMsg') }}
                    @endif
                    </div>
                    <form action="/admin/logar" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Endereço de Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Seu Email">
                        </div>
                        <div class="form-group">
                            <label>Palavra Passe</label>
                            <input type="password" name="password" class="form-control" placeholder="Sua Palavra passe">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Manter-me conectado
                            </label>
                            <label class="pull-right">
                                <a href="#">Esqueceu a palavra passe?</a>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Logar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>