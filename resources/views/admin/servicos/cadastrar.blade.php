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
                        <h1><i class="fa fa-list"></i> Serviços</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href={{ route('admin.index') }}>Dashboard</a></li>
                            <li class="active">Cadastrar</li>
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
                        <strong class="card-title"><i class="fa fa-plus-circle"></i> Cadastrar Serviço</strong>
                    </div>
                    <div class="card-body">
                        <!-- Formulário de Cadastro de Serviço --> 
                        <div id="pay-invoice">
                            <div class="card-body">
                                <form action="/admin/servicos/create" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="designacao"
                                                class="control-label mb-1">Serviço</label>
                                                <input type="text" id="designacao" name="designacao" placeholder="Nome do serviço" class="form-control" required value={{ old('designacao') }}>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="preco"
                                                class="control-label mb-1">Preço</label>
                                                <input type="number" id="preco" name="preco" placeholder="Preço do serviço (kz)" class="form-control" required value={{ old('preco') }}>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" name="user_id" value={{ session()->get('user')->id }} hidden>
                                    <div>
                                        <button id="payment-button" type="submit"
                                            class="btn btn-lg btn-info btn-block">
                                            <i class="fa fa-plus"></i>&nbsp;
                                            <span id="payment-button-amount">Cadastrar</span>
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