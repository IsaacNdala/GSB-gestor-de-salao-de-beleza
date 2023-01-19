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
                        <h1><i class="fa fa-user"></i> Funcionários</h1>
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
                        <strong class="card-title"><i class="fa fa-plus-circle"></i> Cadastrar Funcionário</strong>
                    </div>
                    <div class="card-body">
                        <!-- Formulário de Cadastro de Funcionario --> 
                        <div id="pay-invoice">
                            <div class="card-body">
                                <form action="/admin/funcionarios/create" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nome" class="control-label mb-1">Nome Completo</label>
                                        <input 
                                            id="nome" name="nome" type="text"
                                            class="form-control"
                                            placeholder="Nome completo do funcionario"
                                            required
                                            value={{ old('nome') }}>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="sexo" class="control-label mb-1">Sexo</label>
                                                <select name="sexo" id="sexo" class="form-control form-control" required value={{ old('sexo') }}>
                                                    <option value="M">Masculino</option>
                                                    <option value="F">Femenino</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="data_nascimento" class="control-label mb-1">Nascimento</label>
                                                <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" required value={{ old('data_nascimento') }}>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="funcao" class="control-label mb-1">Funcao</label>
                                                <select name="funcao" id="funcao" class="form-control form-control" required value={{ old('funcao') }}>
                                                    <option value="Barbeiro(a)">Barbeiro(a)</option>
                                                    <option value="Cabelereiro(a)">Cabelereiro(a)</option>
                                                    <option value="Estética">Estética</option>
                                                    <option value="Gerente">Gerente</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="salario" class="control-label mb-1">Salário</label>
                                                <input type="number" id="salario" name="salario" class="form-control" required value={{ old('salario') }}>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="tel"
                                                class="control-label mb-1">Telefone</label>
                                                <input type="text" id="tel" name="tel" placeholder="Telefone" class="form-control" required value={{ old('tel') }}>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="bi"
                                                class="control-label mb-1">Nº BI</label>
                                                <input type="text" id="bi" name="bi" placeholder="Número do BI" class="form-control" required value={{ old('bi') }}>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="email"
                                                class="control-label mb-1">Email</label>
                                                <input type="email" id="email" name="email" placeholder="email" class="form-control" required value={{ old('email') }}>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="password"
                                                class="control-label mb-1">Senha</label>
                                                <input type="password" id="password" name="password" placeholder="Crie uma senha" class="form-control" required value={{ old('password') }}>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="morada" class="control-label mb-1">Morada</label>
                                        <input 
                                            id="morada" name="morada" type="text"
                                            class="form-control"
                                            placeholder="Cidade, Municipio, Bairro..." 
                                            required value={{ old('morada') }}>
                                    </div>
                                    <div class="my-3 text-right">
                                        <label for="imagem" class="btn btn-dark">Escolher Imagem</label>
                                        <input type="file" name="imagem" id="imagem" required>
                                    </div>
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