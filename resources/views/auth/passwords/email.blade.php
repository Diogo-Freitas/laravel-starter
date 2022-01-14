@extends('layouts.app')

@section('title', 'Panel - Link de redefinição de senha')

@section('content')<div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                @if (Session::has('status'))
                    <div class="alert bg-success text-white fade show">
                        <button type="button" class="close text-white" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><i class="icon fas fa-check"></i> {!! Session::get('status') !!}</span>
                    </div><!-- .alert -->
                @endif
                @include('panel.layouts.message')
                <div class="px-4 py-4 bg-white box-shadow rounded">
                    <form class="user" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <label class="small">Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e enviaremos um link de redefinição de senha que permitirá que você escolha uma nova.</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="inputEmail" placeholder="E-mail" required>
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        </div>
                        <button type="submit" class="btn btn-dark btn-block" data-spinner="<small>ENVIANDO LINK DE REDEFINIÇÃO DE SENHA</small>"><small>ENVIAR LINK DE REDEFINIÇÃO DE SENHA</small></button>
                    </form>
                </div>

            </div>
        </div>

    </div>
@endsection
