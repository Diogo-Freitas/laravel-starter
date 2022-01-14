@extends('panel.layouts.app')

@section('title', 'Panel - Usuários')

@section('main')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Usuários</li>
        </ol>
    </nav>

    @include('panel.layouts.message')

    <div class="card mb-4">
        <div class="d-flex justify-content-between align-items-center card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Usuários</h6>
            <div class="card-tools">
                <a href="{{ route('panel.user.create') }}" class="btn btn-success btn-sm py-2 px-4 border-0">Cadastrar</a>
            </div><!-- .card-tools -->
        </div><!-- .d-flex -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Aprovado</th>
                            <th style="width: 100px">Opção</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Aprovado</th>
                            <th>Opção</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td><a href="{{ route('panel.user.show', $user->id) }}">{{ $user->name }}</a></td>
                                <td>{{ $user->email }}</td>
                                <td>{!! $user->approved ? '<b class="text-success">Sim</b>' : '<b class="text-danger">Não</b>' !!}</td>
                                <td>
                                    <a href="{{ route('panel.user.update', $user->id) }}" class="btn btn-outline-warning btn-sm border-0"><i class="far fa-edit"></i></a>
                                    <form method="POST" action="{{ route('panel.user.destroy', $user->id) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm border-0 btn-delete" title="Deseja excluir este usuário?"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                },
                "pageLength": 25,
            });

        });
    </script>
    <!-- Exibir alerta de configrmação quando clicar em excluir -->
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.script.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">

@endsection
