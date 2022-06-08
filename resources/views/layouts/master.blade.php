<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>OdinBI</title>
    <link rel="apple-touch-icon" href="/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/app-assets/images/ico/favicon.ico">
    <!-- BEGIN: Vendor CSS-->
        @include('layouts.css.master')
        @stack('css')
    <!-- END: Vendor CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="{{ $class ?? 'vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static'}}" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
@auth()
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
    </form>

<!-- BEGIN: Header-->
@include('layouts.navbars.navbar')
<!-- END: Header-->

<!-- BEGIN: Main Menu-->
@include('layouts.navbars.sidebar')
<!-- END: Main Menu-->
@endauth
<!-- BEGIN: Content-->
<div class="app-content content" id="app-content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Content Start -->
            @yield('content')
            <!-- Content end -->
        </div>
    </div>
</div>
<!-- END: Content-->


@include('layouts.js.master')
@stack('js')

</body>
</html>
