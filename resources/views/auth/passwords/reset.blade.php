@extends('layouts.app')

@section('title', 'Panel - Modificar senha')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="px-4 py-4 bg-white box-shadow rounded">
                    <form class="user" method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <label class="small">E-mail</label>
                            <input type="email" name="email" value="{{ $email ?? old('email') }}" class="form-control @error('email') is-invalid @enderror" id="inputEmail" required>
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        </div>
                        <div class="form-group">
                            <label class="small">Senha</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword" required>
                            <small class="text-danger">{{ $errors->first('password') }}</small>
                        </div>
                        <div class="form-group">
                            <label class="small">Confirmação de Senha</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="inputPasswordConfirmation" required>
                            <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                        </div>
                        <button type="submit" class="btn btn-dark btn-block"><small>MODIFICAR SENHA</small></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
