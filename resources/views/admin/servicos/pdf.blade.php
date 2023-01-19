
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
                        <h1>Serviços</h1>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Serviço</th>
                                    <th>Preço</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($servicos) > 0)
                                    @foreach ($servicos as $servico)
                                    <tr>
                                        <td>{{ $servico->designacao }}</td>
                                        <td>{{ $servico->preco }} kz</td>
                                        <td>{{ $servico->created_at }}</td>
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