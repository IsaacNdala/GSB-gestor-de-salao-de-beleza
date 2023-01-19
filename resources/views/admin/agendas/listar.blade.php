@extends('admin.layouts.default')

@section('title', 'GSB - Funcionários')

@push('data-table-styles')
<link rel="stylesheet" href={{ asset('css/lib/datatable/dataTables.bootstrap.min.css') }}>
@endpush

{{-- Injetando CSS  --}}
@push('styles')
<link rel="stylesheet" href={{ asset('css/funcionarios.css') }}>
@endpush

@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><i class="fa fa-calendar"></i> Serviços Agendados</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="/">Dashboard</a></li>
                            <li class="active">Agendas</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">
        @if (session()->get('msg'))
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                    <span class="badge badge-pill badge-success">Sucesso</span>
                    {{ session()->get('msg') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>  
        @endif

        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Tabela</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Serviço</th>
                                    <th>Data</th>
                                    <th>Hora Inicial</th>
                                    <th>Hora Final</th>
                                    <th>Cliente</th>
                                    <th>Funcionários</th>
                                    <th>Status</th>
                                    <th>Finalizar</th>
                                    <th>Deletar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($agendas) > 0)
                                    @foreach ($agendas as $agenda)
                                    <tr>
                                        <td>{{ $agenda->servico->designacao }}</td>
                                        <td>{{ $agenda->data }}</td>
                                        <td>{{ $agenda->hora_inicial     }}</td>
                                        <td>{{ $agenda->hora_final}}</td>
                                        <td>{{ $agenda->cliente->user->nome }}</td>
                                        <td>{{ $agenda->user->nome }}</td>
                                        <td class="text-info">{{ $agenda->status }}</td>
                                        <td class="text-center"><button type="button" data-toggle="modal" data-target={{ '#' . 'finalizar-modal' . $loop->index }} class="btn btn-success"><i class="fa fa-check-square-o"></i></button></td>
                                        <td class="text-center"><button type="button" class="btn btn-danger" data-toggle="modal" data-target={{ '#' . 'delete-modal' . $loop->index }}><i class="fa fa-trash"></i></button></td>

                                         {{-- Modal Para Finalizar --}}
                                         <div class="modal fade" id={{ 'finalizar-modal' . $loop->index }} tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-md" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="smallmodalLabel"><i class="fa fa-check-square-o"></i> Finalizar</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-black">
                                                        <p>
                                                            <b><i class="fa fa-list"></i> Serviço: </b> {{ $agenda->servico->designacao }}
                                                        </p>
                                                        <p>
                                                            <b><i class="fa fa-money"></i> Preço: </b> {{ $agenda->servico->preco }} kz
                                                        </p>
                                                        <p>
                                                            <b><i class="fa fa-user"></i> Cliente: </b> {{ $agenda->cliente->user->nome }}
                                                        </p>
                                                        <form action="/admin/agendas/finalizar" method="POST">
                                                        {{-- <div class="form-group">
                                                            <label for="forma_pagamento_id" class="control-label mb-1">Forma de pagamento</label>
                                                            <select name="forma_pagamento_id" id="forma_pagamento_id" class="form-control form-control" required value={{ old('servicos') }}>
                                                                @if (count($forma_pagamentos) > 0)
                                                                    @foreach ($forma_pagamentos as $fp)
                                                                        <option value={{ $fp->id }}>{{ $fp->designacao }}</option> 
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div> --}}

                                                        <input type="text" name="user_id" value={{ session()->get('user')->id; }} hidden>
                                                        <input type="text" name="servico_id" value={{ $agenda->servico->id }} hidden>
                                                        <input type="text" name="cliente_id" value={{ $agenda->cliente->id }} hidden>

                                                        <p>
                                                            Deseja finalizar a agenda?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        
                                                            @csrf
                                                            <input type="text" name="agenda_id" value={{ $agenda->id }} hidden>
                                                            <button type="submit" class="btn btn-success">Confirmar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Modal Para eliminar --}}
                                        <div class="modal fade" id={{ 'delete-modal' . $loop->index }} tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-md" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="smallmodalLabel"><i class="fa fa-trash"></i> Deletar</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>
                                                            Deseja deletar a agenda?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <form action="/admin/agendas/deletar" method="POST">
                                                            @csrf
                                                            <input type="text" name="agenda_id" value={{ $agenda->id }} hidden>
                                                            <button type="submit" class="btn btn-danger">Confirmar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>    
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
@endsection


@push('scripts')
<script src={{ asset('js/lib/data-table/datatables.min.js') }}></script>
<script src={{ asset('js/lib/data-table/dataTables.bootstrap.min.js') }}></script>
<script src={{ asset('js/lib/data-table/dataTables.buttons.min.js') }}></script>
<script src={{ asset('js/lib/data-table/buttons.bootstrap.min.js') }}></script>
<script src={{ asset('js/lib/data-table/jszip.min.js') }}></script>
<script src={{ asset('js/lib/data-table/vfs_fonts.js') }}></script>
<script src={{ asset('js/lib/data-table/buttons.html5.min.js') }}></script>
<script src={{ asset('js/lib/data-table/buttons.print.min.js') }}></script>
<script src={{ asset('js/lib/data-table/buttons.colVis.min.js') }}></script>
<script src={{ asset('js/init/datatables-init.js') }}></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#bootstrap-data-table-export').DataTable();
} );
</script>
@endpush