<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/backend/img/pharmacy_logo.png') }}" />

    <!--=== Bootstrap 4 ===-->
    <link rel="stylesheet" href="{{ asset('assets/common/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/backend/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('assets/backend/css/admin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/custom.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/backend/css/OverlayScrollbars.min.css') }}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/toastr.css') }}">
    @yield('css')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <style>
        .select2-container .select2-selection--single {
            height: 36px !important;
        }
        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da;
            padding: 5px !important;
        }
        .tc-font {
            font-family: Kalpurush
        }
    </style>

    <div class="wrapper">
        <!-- Navbar -->
        @include('user.partials.header')
        @include('user.partials.sidebar')
        @yield('content')
        @include('user.partials.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets/common/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets/common/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/common/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/common/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('assets/common/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets/backend/js/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/backend/js/adminlte.js') }}"></script>
    <script src="{{ asset('assets/backend/js/toastr.js') }}"></script>
    @include('user.partials.notifications')
    @yield('js')

</body>
</html>
