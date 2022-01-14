@extends('panel.layouts.app')

@section('title', 'Panel - Profile')

@section('main')

    <div id="profile">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Meu Perfil</h1>
        </div>

        @include('panel.layouts.message')

        <div class="row">
            <div class="col-md-6 mb-4">

                <div class="card mb-4">
                    <div class="card-header">Meu perfil</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('panel.profile.update') }}">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label class="required" for="name">Nome</label>
                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                                       name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required>
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="required" for="title">E-mail</label>
                                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text"
                                       name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required>
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">
                                    Atualizar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Alterar senha</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('panel.profile.password.update') }}">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label class="required" for="current_password">Senha</label>
                                <input class="form-control {{ $errors->has('current_password') ? 'is-invalid' : '' }}"
                                       type="password" name="current_password" id="current_password" required>
                                @if ($errors->has('current_password'))
                                    <span class="text-danger">{{ $errors->first('current_password') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="required" for="password">Nova senha</label>
                                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                       type="password" name="password" id="password" required>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="required" for="password_confirmation">Confirme a nova senha</label>
                                <input class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                       type="password" name="password_confirmation" id="password_confirmation" required>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">
                                    Atualizar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div class="col-md-6">

                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Foto do perfil</div>
                    <div class="card-body text-center">
                        <form id="avatarUpdate" method="POST" action="{{ route('panel.profile.avatar.update') }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <!-- Profile picture image-->
                            @if (Auth::user()->avatar)
                                <a class="delete" href="{{ route('panel.profile.avatar.destroy') }}" data-toggle="tooltip" data-placement="top" title="Excluir"><img class="img-profile rounded-circle mb-3" src="{{ asset(Auth::user()->avatar) }}" alt=""></a>
                            @else
                                <img class="img-profile rounded-circle mb-3" src="{{ asset('img/undraw_profile.svg') }}" alt="">
                            @endif

                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4">JPG ou PNG menor do que 5 MB</div>
                            <!-- Profile picture input-->
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" name="avatar" accept=".jpg, .jpeg, .png" class="custom-file-input {{ $errors->has('avatar') ? 'is-invalid' : '' }}" id="customFile">
                                    <label id="file" class="custom-file-label" for="customFile" data-browse="Enviar nova foto"></label>
                                    <div class="invalid-feedback custom-file-invalid">{{ $errors->first('avatar') }}</div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mt-4 mb-4">
                    <div class="card-header">Autenticação de dois fatores</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('panel.profile.toggleTwoFactor') }}">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                @if (auth()->user()->two_factor)
                                    <button class="btn btn-danger" type="submit">Desativar autenticação de dois fatores</button>
                                @else
                                    <button class="btn btn-success" type="submit">Ativar autenticação de dois fatores</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">Excluir conta</div>
                    <div class="card-body">
                        <div class="form-group">
                            <p>Excluir sua conta é uma ação permanente e não poderá ser desfeita.</p>
                            <a href="{{ route('panel.profile.destroy') }}" class="btn btn-danger btn-delete" title="Tem certeza que deseja excluir a sua conta?">Eu entendo, exclua a minha conta.</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div><!-- #profile -->

@endsection

@section('scripts')
    <!-- Exibir alerta de configrmação -->
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.script.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
    <!-- Verificar se o arquivo é válido -->
    <script>
        $("#customFile").on("change", function(e) {
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), ['jpg', 'png', 'jpeg']) == -1) {
                $(this).addClass("is-invalid").val('');
                $(".custom-file-invalid").text('O arquivo deve ser do tipo JPG ou PNG.');
            } else {
                if ($(this)[0].files[0].size > 5120000) {
                    $(this).addClass("is-invalid").val('');
                    $(".custom-file-invalid").text('O arquivo deve ter no máximo 5 MB.');
                } else {
                    $('#avatarUpdate').submit();
                }
            }
        });
    </script>
@endsection
