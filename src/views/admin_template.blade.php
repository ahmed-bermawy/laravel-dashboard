<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard | {{ $pageTitle ?? 'Home' }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link href="{{ asset("css/dashboard/dashboard.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("css/dashboard/dashboard-custom.css")}}" rel="stylesheet" type="text/css"/>
    <!-- icon -->
    <link rel="icon" href="{{ asset('img/dashboard/favicon.png') }}">

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">

    <!-- Header -->
@include('dashboard.header')

<!-- Sidebar -->
@include('dashboard.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="text-center">
                {{ $pageTitle ?? '' }}
                <small>{{ $page_description ?? ''}}</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="container-fluid">
            <!-- Your Page Content Here -->
            @yield('content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Footer -->
    @include('dashboard.footer')


    <script src="{{ asset ("js/dashboard/dashboard.js") }}"></script>
    <!-- REQUIRED JS SCRIPTS -->
    <script src="{{ asset ("js/dashboard/jquery.min.js") }}"></script>
    <script src="{{ asset ("js/dashboard/jquery-ui.min.js") }}"></script>

    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    {{--    <script src="{{ asset ("/dashboard-asset/js/main.js") }}"></script>--}}

    @yield('custoJs')
</div>
@include('dashboard.components.customjs.adminTemplateCustomJs')

</body>
</html>
