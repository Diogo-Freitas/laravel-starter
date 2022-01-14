@extends('layouts.app')

@section('title', 'Panel - Autenticação de dois fatores')

@section('content')

    <div id="content">

        <div class="row justify-content-center">
            <div class="col-md-9">
                @include('panel.layouts.message')
                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('twoFactor.check') }}">
                                @csrf
                                <h1>Autenticação de dois fatores</h1>
                                <p class="text-muted">O código de autenticação de dois fatores foi enviado por e-mail. O código é válido por 15 minutos. Se você não recebeu, pressione reenviar.</p>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                    </div>
                                    <input name="two_factor_code" type="text" class="form-control{{ $errors->has('two_factor_code') ? ' is-invalid' : '' }}" required autofocus placeholder="Código de Dois Fatores">
                                    @if ($errors->has('two_factor_code'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('two_factor_code') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary px-4">Verificar</button>
                                    </div>
                                    <div class="col-6 text-right">
                                        <a class="btn btn-secondary px-4" href="{{ route('twoFactor.resend') }}" data-spinner="Reenviando...">Reenviar</a>
                                        <a class="btn btn-danger px-4" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">Sair</a>
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
