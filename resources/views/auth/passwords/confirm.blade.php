@extends('layouts.app')

@section('title', 'Panel - Confirmação de senha')

@section('content')

    <div id="content">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-body">
                            @if (session()->has('message'))
                                <p class="alert alert-info">
                                    {{ session()->get('message') }}
                                </p>
                            @endif
                            <form method="POST" action="{{ route('password.confirm') }}">
                                @csrf
                                <h1>Confirmação de senha</h1>
                                <p class="text-muted">Por favor, confirme sua senha para continuar.</p>

                                <div class="form-group">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword" placeholder="Senha" required>
                                    <small class="text-danger">{{ $errors->first('password') }}</small>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary px-4">Confirmar senha</button>
                                    </div>
                                    <div class="col-6 text-right">
                                         <a class="btn btn-link pt-2 px-0 m-0 align-baseline" href="{{ route('password.request') }}">Esqueceu sua senha?</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>

    </div>
@endsection
