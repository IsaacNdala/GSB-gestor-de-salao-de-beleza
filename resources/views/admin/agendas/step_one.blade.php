@extends('admin.layouts.default')

@section('title', 'GSB - Clientes')

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
                            <li><a href={{ route('admin.index') }}>Dashboard</a></li>
                            <li class="active">Serviços</li>
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

        {{-- Alert para validar se email e telefone existem --}}
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
                        <strong class="card-title"><i class="fa fa-plus-circle"></i> Passo 1</strong>
                    </div>
                    <div class="card-body">
                        <div id="pay-invoice">
                            <div class="card-body">
                                <form action="/admin/agendas/agendar" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="data"
                                                class="control-label mb-1">Selecione a Data</label>
                                                <input type="date" id="data" name="data" class="form-control" required value={{ old('data') }}>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="hora_inicial"
                                                class="control-label mb-1">Hora Inicial</label>
                                                <input type="time" id="hora_inicial" name="hora_inicial" placeholder="Hora inicial" class="form-control" required value={{ old('hora_inicial') }}>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="hora_final"
                                                class="control-label mb-1">Hora Final</label>
                                                <input type="time" id="hora_final" name="hora_final" placeholder="Hora final" class="form-control" required value={{ old('hora_final') }}>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cliente_id" class="control-label mb-1">Cliente</label>
                                                <select name="cliente_id" id="cliente_id" class="form-control form-control" required>
                                                    @if (count($clientes) > 0)
                                                        @foreach ($clientes as $cliente)
                                                            <option value={{ $cliente->id }}>{{ $cliente->user->nome }}</option> 
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button id="payment-button" type="submit"
                                            class="btn btn-lg btn-info btn-block">
                                            <i class="fa fa-arrow-right"></i>&nbsp;
                                            <span id="payment-button-amount">Próximo</span>
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