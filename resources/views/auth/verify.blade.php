@extends('layouts.app')

@section('title', 'Panel - Verificação de E-mail')

@section('content')

    <div id="content">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (Session::has('resent'))
                    <div class="alert bg-success text-white fade show">
                        <button type="button" class="close text-white" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><i class="icon fas fa-check"></i> Um novo link de verificação foi enviado para o seu endereço de e-mail.</span>
                    </div><!-- .alert -->
                @endif
                @include('panel.layouts.message')
                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <h1 class="pb-4">Verifique seu endereço de email</h1>
                                <p>Antes de prosseguir, por favor, veja se recebeu o link de verificação em seu email.</p>
                                <p>Se você não recebeu o email, <button class="btn btn-link p-0 m-0 align-baseline" type="submit" data-spinner="Enviando...">clique aqui para solicitar outro.</button></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
