@extends('layouts.app')

@section('title', 'Panel - Registrar')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
            @include('panel.layouts.message')
                <div class="px-4 py-4 bg-white box-shadow rounded">

                    <form class="user" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label class="small">Nome</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="inputName" required>
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        </div>
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
                        <div class="form-group">
                            <label class="small">Confirmação de Senha</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="inputPasswordConfirmation" required>
                            <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                        </div>
                        <button type="submit" class="btn btn-dark btn-block" data-spinner="<small>REGISTRANDO...</small>"><small>REGISTRAR</small></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
