@extends('admin.layouts.default')

@section('title', 'GSB - Clientes')

@push('data-table-styles')
<link rel="stylesheet" href={{ asset('css/lib/datatable/dataTables.bootstrap.min.css') }}>
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
                            <li><a href="/">Dashboard</a></li>
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

        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-end">
                <a href={{ route('servicos.cadastrar') }} class="btn btn-info mr-3"><i class="fa fa-plus"></i> Cadastrar</a>
                <a href={{ route('servicos.pdf') }} class="btn btn-danger">Exportar PDF</a>
            </div>
        </div>

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
                                    <th>Preço</th>
                                    <th>Data</th>
                                    <th>Editar</th>
                                    <th>Deletar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($servicos) > 0)
                                    @foreach ($servicos as $servico)
                                    <tr>
                                        <td>{{ $servico->designacao }}</td>
                                        <td>{{ $servico->preco }} kz</td>
                                        <td>{{ $servico->created_at }}</td>
                                        <td class="text-center"><a href={{ route('servicos.editar', ['id' => $servico->id]) }} class="btn btn-dark"><i class="fa fa-edit"></i></a></td>
                                        <td class="text-center"><button type="button" class="btn btn-danger" data-toggle="modal" data-target={{ '#' . 'delete-modal' . $loop->index }}><i class="fa fa-trash"></i></button></td>

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
                                                            Deseja deletar "{{ $servico->designacao  }}"?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <form action="/admin/servicos/deletar" method="POST">
                                                            @csrf
                                                            <input type="text" name="servico_id" value={{ $servico->id }} hidden>
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