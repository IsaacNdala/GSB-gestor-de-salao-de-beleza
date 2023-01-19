@extends('admin.layouts.default')

@section('title', 'GSB - Funcionários')

@push('data-table-styles')
<link rel="stylesheet" href={{ asset('css/lib/datatable/dataTables.bootstrap.min.css') }}>
@endpush

{{-- Injetando CSS  --}}
@push('styles')
<link rel="stylesheet" href={{ asset('css/clientes.css') }}>
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
                            <li><a href={{ route('admin.index') }}>Dashboard</a></li>
                            <li class="active">Agendar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">
        {{-- Alerts para verificar validacao --}}
        @if ($errors)
        @foreach ($errors->all() as $error)
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                    <span class="badge badge-pill badge-danger">Erro</span>
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
        @endif

        @if (session()->get('errorMsg'))
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                    <span class="badge badge-pill badge-danger">Erro</span>
                    {{ session()->get('errorMsg') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title"><i class="fa fa-plus-circle"></i> Passo 2</strong>
                    </div>
                    <div class="card-body">
                        <div id="pay-invoice">
                            <div class="card-body">
                                <form action="/admin/agendas/create" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="servico_id" class="control-label mb-1">Serviços</label>
                                                <select name="servico_id" id="servico_id" class="form-control form-control" required value={{ old('servicos') }}>
                                                    @if (count($servicos) > 0)
                                                        @foreach ($servicos as $servico)
                                                            <option value={{ $servico->id }}>{{ $servico->designacao }}</option> 
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="servicos" class="control-label mb-1">Funcionário</label>
                                                <select name="servicos" id="servicos" class="form-control form-control" required value={{ old('servicos') }}>
                                                    @if (count($funcionarios) > 0)
                                                        @foreach ($funcionarios as $funcionario)
                                                            <option value={{ $funcionario->id }}>{{ $funcionario->user->nome }}</option> 
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" name="data" value={{ $data }} hidden>
                                    <input type="text" name="status" value="Pendente" hidden>
                                    <input type="text" name="hora_inicial" value={{ $hora_inicial }} hidden>
                                    <input type="text" name="hora_final" value={{ $hora_final }} hidden>
                                    <input type="text" name="cliente_id" value={{ $cliente_id }} hidden>
                                    <input type="text" name="user_id" value={{ session()->get('user')->id }} hidden>
                                    <div class="text-right">
                                        <a href={{ url()->previous() }} class="btn btn-secondary">
                                            Voltar
                                        </a>
                                        <button class="btn btn-info" type="submit">
                                            Agendar
                                        </button>
                                    </div>  
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- .card -->

            </div><!--/.col-->
        </div>

    </div>
</div>

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