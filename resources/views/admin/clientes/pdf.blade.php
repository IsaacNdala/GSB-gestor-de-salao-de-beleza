
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GSB - Gestor de Salão de Beleza</title>
    <style>
        table {
            width: 100%;
            border: 1px solid black;
        }
        td {
            text-align: center;
            border: 1px solid black;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Clientes</h1>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Tel</th>
                                    <th>Email</th>
                                    <th>Sexo</th>
                                    <th>Morada</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($clientes) > 0)
                                    @foreach ($clientes as $cliente)
                                    <tr>
                                        <td>{{ $cliente->user->nome }} </td>
                                        <td>{{ $cliente->user->tel }} </td>
                                        <td>{{ $cliente->user->email }}</td>
                                        <td>{{ $cliente->user->sexo }}</td>
                                        <td>{{ $cliente->user->morada }}</td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
</div>
</body>
</html>