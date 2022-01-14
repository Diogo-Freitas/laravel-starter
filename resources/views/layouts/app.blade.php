<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <meta name="author" content="Diogo-Freitas">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Custom fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles -->
    <link href="{{ asset('css/panel.css') }}" rel="stylesheet">
    <style>
        html,
        body {
            margin: 0;
            width: 100%;
            height: 100vh;
            position: relative;
            background-color: #f8f9fc;
        }

        #content {
            display: flex;
            min-height: 100vh;
            align-items: center;
            padding-bottom: 50px;
            justify-content: center;
        }

        #content .box-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

    </style>
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
    <title>@yield('title', 'Panel')</title>
</head>

<body>

    <!-- Main Content -->
    <div id="content">
        @yield('content')
    </div>
    <!-- End of Main Content -->

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/panel.js') }}"></script>

    @yield('scripts')

</body>

</html>
