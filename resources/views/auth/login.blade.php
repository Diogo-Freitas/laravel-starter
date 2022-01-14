@extends('layouts.app')

@section('title', 'Panel - Login')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-5">

                @include('panel.layouts.message')

                <div class="px-4 py-4 bg-white box-shadow rounded">

                    <form class="user" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label class="small">E-mail</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="inputEmail" required>
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        </div>
                        <div class="form-group">
                            <label class="small">Senha</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword" required>
                            <small class="text-danger">{{ $errors->first('password') }}</small>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" name="remember" class="custom-control-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">Manter conectado</label>
                                </div>

                            </div>
                            <div class="text-center">
                                <a class="small text-dark" href="{{ route('password.request') }}">Esqueceu sua senha?</a>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark btn-block" data-spinner="ENTRANDO...">ENTRAR</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
