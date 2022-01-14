@extends('panel.layouts.app')

@section('title', 'Panel - Usuários / Editar / ' . $user->name)

@section('main')

    <div id="user">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('panel.user') }}">Usuários</a></li>
                <li class="breadcrumb-item"><a href="{{ route('panel.user.edit', $user->id) }}">Editar</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('panel.user.show', $user->id) }}">{{ $user->name }}</a></li>
            </ol>
        </nav>

        @include('panel.layouts.message')

        <div class="row">
            <div class="col-xl-6 mb-4">

                <div class="card mb-4">
                    <form method="POST" action="{{ route('panel.user.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Editar Usuário</h6>
                        </div><!-- .card-header -->

                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Nome</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="inputName" name="name" value="{{ $user->name }}">
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            </div><!-- .form-group -->
                            <div class="form-group">
                                <label for="inputEmail">E-mail</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="inputEmail" name="email" value="{{ $user->email }}">
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            </div><!-- .form-group -->
                            <div class="form-group">
                                <label for="inputPassword">Senha</label>
                                <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="inputPassword" name="password">
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            </div><!-- .form-group -->
                            <div class="form-group">
                                <label for="inputEmailVerifiedAt">Verificado</label>
                                <input type="datetime-local" class="form-control {{ $errors->has('email_verified_at') ? 'is-invalid' : '' }}" id="inputEmailVerifiedAt" name="email_verified_at" value="{{ $user->email_verified_at_local }}">
                                <span class="text-danger">{{ $errors->first('email_verified_at') }}</span>
                            </div><!-- .form-group -->
                            <div class="form-group">
                                <label for="selectApproved">Aprovado</label>
                                <select class="form-control {{ $errors->has('approved') ? 'is-invalid' : '' }}" id="selectApproved" name="approved">
                                    <option value="1" {{ $user->approved ? 'selected' : '' }}>Sim</option>
                                    <option value="0" {{ $user->approved ? '' : 'selected' }}>Não</option>
                                </select>
                                <span class="text-danger">{{ $errors->first('approved') }}</span>
                            </div><!-- .form-group -->
                            <div class="form-group">
                                <label for="selectRole">Permissão</label>
                                <select class="form-control {{ $errors->has('is_admin') ? 'is-invalid' : '' }}" id="selectRole" name="is_admin">
                                    <option value="1" {{ $user->is_admin ? 'selected' : '' }}>Administrador</option>
                                    <option value="0" {{ $user->is_admin ? '' : 'selected' }}>Usuário</option>
                                </select>
                                <span class="text-danger">{{ $errors->first('is_admin') }}</span>
                            </div><!-- .form-group -->
                        </div><!-- .card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-block btn-primary">Atualizar</button>
                        </div><!-- .card-footer -->

                    </form>
                </div><!-- .card -->

            </div>

            <div class="col-xl-6">

                <div class="card mb-4 mb-xl-0">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Foto de Perfil do Usuário</h6>
                    </div><!-- .card-header -->
                    <div class="card-body text-center">
                        <form id="avatarUpdate" method="POST" action="{{ route('panel.user.avatar.update', $user->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Profile picture image-->
                            @if ($user->avatar)
                                <a class="delete" href="{{ route('panel.user.avatar.destroy', $user->id) }}" data-toggle="tooltip" data-placement="top" title="Excluir"><img class="img-profile rounded-circle mb-3" src="{{ asset($user->avatar) }}" alt=""></a>
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
                    </div><!-- .card-body -->
                </div><!-- .card -->

                <div class="card mt-4 mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Autenticação de Dois Fatores</h6>
                    </div><!-- .card-header -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('panel.user.toggleTwoFactor', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                @if ($user->two_factor)
                                    <button class="btn btn-danger" type="submit">Desativar autenticação de dois fatores</button>
                                @else
                                    <button class="btn btn-success" type="submit">Ativar autenticação de dois fatores</button>
                                @endif
                            </div>
                        </form>
                    </div><!-- .card-body -->
                </div><!-- .card -->

                <div class="card mt-4 mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Excluir Conta de Usuário</h6>
                    </div><!-- .card-header -->
                    <div class="card-body">
                        <form class="form-deletes" method="POST" action="{{ route('panel.user.destroy', $user->id) }}">
                            @csrf
                            @method('DELETE')
                            <div class="form-group">
                                <button class="btn btn-danger btn-deletes" type="submit" title="Deseja excluir este Usuário?">Excluir</button>
                            </div>
                        </form>
                    </div><!-- .card-body -->
                </div><!-- .card -->

            </div><!-- .col-xl-6 -->
        </div><!-- .row -->

    </div><!-- #user -->

@endsection

@section('scripts')
    <!-- Exibir alerta de configrmação quando clicar em excluir -->
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
