@extends('panel.layouts.app')

@section('title', 'Panel - Usuários / Cadastar')

@section('main')

    <div id="user">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('panel.user') }}">Usuários</a></li>
                <li class="breadcrumb-item"><a href="{{ route('panel.user.create') }}">Cadastrar</a></li>
            </ol>
        </nav>

        @include('panel.layouts.message')

        @if (Session::has('user'))
            <div class="d-flex flex-row mb-3">
                <a href="{{ route('panel.user.create') }}" class="btn btn-outline-primary px-4 mr-2">Novo</a>
                <a href="{{ route('panel.user.edit', Session::get('user.id')) }}" class="btn btn-outline-warning px-4 mr-2">Editar</a>
                <form method="POST" action="{{ route('panel.user.destroy', Session::get('user.id')) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger px-4 btn-delete" title="Deseja excluir este usuário?">Excluir</button>
                </form>
            </div><!-- /.card -->
        @endif

        <form method="POST" action="{{ route('panel.user.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Cadastrar Usuário</h6>
                        </div><!-- .card-header -->

                        <div class="card-body">
                            <div class="form-group">
                                <label class="required" for="inputName">Nome</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="inputName" name="name" value="{{ old('name') }}" required>
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            </div><!-- .form-group -->
                            <div class="form-group">
                                <label class="required" for="inputEmail">E-mail</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="inputEmail" name="email" value="{{ old('email') }}" required>
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            </div><!-- .form-group -->
                            <div class="form-group">
                                <label class="required" for="inputPassword">Senha</label>
                                <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="inputPassword" name="password" required>
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            </div><!-- .form-group -->
                            <div class="form-group">
                                <label for="inputEmailVerifiedAt">Verificado</label>
                                <input type="datetime-local" class="form-control {{ $errors->has('email_verified_at') ? 'is-invalid' : '' }}" id="inputEmailVerifiedAt" name="email_verified_at" value="old('email_verified_at')">
                                <span class="text-danger">{{ $errors->first('email_verified_at') }}</span>
                            </div><!-- .form-group -->
                            <div class="form-group">
                                <label class="required" for="selectApproved">Aprovado</label>
                                <select class="form-control {{ $errors->has('approved') ? 'is-invalid' : '' }}" id="selectApproved" name="approved" required>
                                    <option value="1" {{ old('approved') ? 'selected' : '' }}>Sim</option>
                                    <option value="0" {{ old('approved') ? '' : 'selected' }}>Não</option>
                                </select>
                                <span class="text-danger">{{ $errors->first('approved') }}</span>
                            </div><!-- .form-group -->
                            <div class="form-group">
                                <label class="required" for="selectRole">Permissão</label>
                                <select class="form-control {{ $errors->has('is_admin') ? 'is-invalid' : '' }}" id="selectRole" name="is_admin" required>
                                    <option value="1" {{ old('is_admin') ? 'selected' : '' }}>Administrador</option>
                                    <option value="0" {{ old('is_admin') ? '' : 'selected' }}>Usuário</option>
                                </select>
                                <span class="text-danger">{{ $errors->first('is_admin') }}</span>
                            </div><!-- .form-group -->
                        </div><!-- .card-body -->

                    </div><!-- .card -->
                </div><!-- .col-xl-6 -->

                <div class="col-xl-6">
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Foto de Perfil do Usuário</h6>
                        </div><!-- .card-header -->
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            @if (Session::has('user.avatar'))
                                <img id="image-file-upload" class="img-profile rounded-circle mb-3" src="{{ asset(Session::get('user.avatar')) }}" alt="" data="{{ asset('img/undraw_profile.svg') }}">
                            @else
                                <img id="image-file-upload" class="img-profile rounded-circle mb-3" src="{{ asset('img/undraw_profile.svg') }}" alt="" data="{{ asset('img/undraw_profile.svg') }}">
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
                        </div><!-- .card-body -->
                    </div><!-- .card -->
                </div><!-- .col-xl-6 -->
            </div><!-- .row -->

            <div class="card mb-4">
                <button type="submit" class="btn btn-block btn-success">Salvar</button>
            </div><!-- .card-footer -->

        </form>

    </div><!-- #user -->
@endsection

@section('scripts')
    <!-- Exibir alerta de configrmação quando clicar em excluir -->
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.script.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
    <!-- Verificar se o arquivo é válido -->
    <script>
        $("#customFile").on("change", function() {

            var img = $('#image-file-upload');
            var old = $('#image-file-upload').attr('data');
            var message = $(".custom-file-invalid");

            if ($.inArray($(this).val().split('.').pop().toLowerCase(), ['jpg', 'png', 'jpeg']) == -1) {
                $(this).addClass("is-invalid").val('');
                message.text('O arquivo deve ser do tipo JPG ou PNG.');
                img.attr('src', old);

            } else {

                if ($(this)[0].files[0].size > 5120000) {
                    $(this).addClass("is-invalid").val('');
                    message.text('O arquivo deve ter no máximo 5 MB.');
                    img.attr('src', old);
                }
            }

            if ($(this)[0].files && $(this)[0].files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    img.attr('src', e.target.result);
                };
                $(this).removeClass("is-invalid");
                reader.readAsDataURL($(this)[0].files[0]);
            }
        });

        bsCustomFileInput.init()

        var btn = document.getElementById('file')
        var form = document.querySelector('form')
        btn.addEventListener('click', function() {
            form.reset()
        })
    </script>
@endsection
