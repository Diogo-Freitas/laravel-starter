@extends('panel.layouts.app')

@section('title', 'Panel - Usuários / Mostrar / ' . $user->name)

@section('main')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('panel.user') }}">Usuários</a></li>
            <li class="breadcrumb-item"><a href="{{ route('panel.user.show', $user->id) }}">Mostrar</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
        </ol>
    </nav>

    @include('panel.layouts.message')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="  m-0 font-weight-bold text-primary">Usuário</h6>
                <div class="card-tools">
                    <a href="{{ route('panel.user.show', $user->id) }}" class="btn btn-outline-primary btn-sm py-2 border-0"><i class="fas fa-sync-alt"></i></a>
                    <a href="{{ route('panel.user.update', $user->id) }}" class="btn btn-outline-warning btn-sm py-2 border-0"><i class="far fa-edit"></i></a>
                    <form method="post" action="{{ route('panel.user.destroy', $user->id) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm py-2 border-0 btn-delete" title="Deseja excluir este usuário?"><i class="far fa-trash-alt"></i></button>
                    </form>
                </div><!-- .card-tools -->
            </div><!-- .d-flex -->
        </div><!-- .card-header -->
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $user->id }}</td>
                    </tr>
                    <tr>
                        <th>Nome</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Avatar</th>
                        <td><a href="{{ asset($user->avatar) }}">{{ $user->avatar }}</a></td>
                    </tr>
                    <tr>
                        <th>Verificado</th>
                        <td>{{ $user->email_verified_at }}</td>
                    </tr>
                    <tr>
                        <th>Aprovado</th>
                        <td>{{ $user->approved ? 'Sim' : 'Não' }}</td>
                    </tr>
                    <tr>
                        <th>Permissão</th>
                        <td>{{ $user->is_admin ? 'Administrador' : 'Usuário' }}</td>
                    </tr>
                    <tr>
                        <th>Autenticação de Dois Fatores</th>
                        <td>{{ $user->two_factor ? 'Ativado' : 'Desativado' }}</td>
                    </tr>
                    <tr>
                        <th>Atualizado</th>
                        <td>{{ $user->updated_at }}</td>
                    </tr>
                    <tr>
                        <th>Cadastrado</th>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


@endsection

@section('scripts')
    <!-- Exibir alerta de configrmação quando clicar em excluir -->
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.script.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">

@endsection
