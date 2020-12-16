<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Sistem Aplikasi Bank Sampah">
    <title>@yield('title','Bank Sampah')</title>
    <link rel="apple-touch-icon" href="{{ asset('/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendors/css/extensions/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendors/css/forms/select/select2.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/components.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/core/colors/palette-gradient.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('/css/plugins/forms/validation/form-validation.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/pages/app-chat.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <!-- END: Custom CSS-->
    <script src="{{ asset('/vendors/js/vendors.min.js') }}"></script>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns chat-application navbar-floating footer-static menu-collapsed"
    data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto">
                                <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                                    <i class="ficon feather icon-menu"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav bookmark-icons">
                            Hi, Admin
                        </ul>
                        <ul class="nav navbar-nav">

                        </ul>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-user nav-item">
                            @php
                            if(Auth::guard('admin')->check()) {
                                $name = Auth::guard('admin')->user()->name;
                                $level = "Admin";
                                $email = Auth::guard('admin')->user()->email;
                                $bank = Auth::guard('admin')->user()->bank->name;
                            } elseif(Auth::guard('employee')->check()) {
                                $name = Auth::guard('employee')->user()->name;
                                $level = "Pengurus";
                                $email = Auth::guard('employee')->user()->email;
                                $bank = Auth::guard('employee')->user()->bank->name;
                            }
                            @endphp
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none">
                                    <span class="user-name text-bold-600">{{ $name }}</span>
                                    <span class="user-status">{{ $level }}</span>
                                </div>
                                <span>
                                    <img class="round" src="{{ asset('/images/portrait/small/avatar-s-11.jpg') }}"
                                        alt="avatar" height="40" width="40">
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href=""><i class="feather icon-map-pin"></i>{{ $bank ?? "" }}</a>
                                <a class="dropdown-item" href=""><i class="feather icon-mail"></i>{{ $email ?? "" }}</a>
                                <div class="dropdown-divider"></div>
                                @php
                                    $route = null;
                                    if(Auth::guard('admin')->check()){
                                        $route = route('admin.logout');
                                    }else { $route = route('employee.logout'); }
                                @endphp

                                <a class="dropdown-item" href="#" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i class="feather icon-power"></i>
                                    Logout</a>
                            </div>
                            <form id="logout-form" action="{{ $route }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="../../../html/ltr/vertical-collapsed-menu-template/index.html">
                        <img src="{{ asset('/images/logo/logo.png') }}" width="40px">
                        <h6 class="brand-text mb-0">Bank Sampah</h6>
                    </a>
                </li>
                <li class="nav-item nav-toggle">
                    <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                        <i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i
                            class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary"
                            data-ticon="icon-disc">
                        </i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" navigation-header"><span>Master</span>
                </li>
                <li class=" nav-item">
                    <a href="{{ route('admin.index') }}"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Admin">Admin</span></a>
                </li>
                <li class=" nav-item">
                    <a href="{{ route('trash.index') }}"><i class="feather icon-trash"></i><span class="menu-title" data-i18n="Jenis Sampah">Jenis Sampah</span></a>
                </li>
                <li class=" nav-item">
                    <a href="{{ route('bank.index') }}"><i class="feather icon-map-pin"></i><span class="menu-title" data-i18n="Bank">Bank</span></a>
                </li>
                <li class=" nav-item">
                    <a href="{{ route('employee.index') }}"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Pengurus">Pengurus</span></a>
                </li>
                <li class=" navigation-header"><span>Menu</span>
                </li>
                <li class=" nav-item">
                    <a href="{{ route('customer.index') }}"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Nasabah">Nasabah</span></a>
                </li>
                <li class=" nav-item">
                    <a href="{{ route('saving.index') }}"><i class="feather icon-layers"></i><span class="menu-title" data-i18n="Tabungan">Tabungan</span></a>
                </li>
                <li class=" nav-item">
                    <a href="{{ route('message.index') }}"><i class="feather icon-mail"></i><span class="menu-title" data-i18n="Pesan">Pesan</span></a>
                </li>
                {{-- <li class=" nav-item"><a href="#"><i class="feather icon-shopping-cart"></i><span class="menu-title"
                            data-i18n="Ecommerce">Ecommerce</span></a>
                    <ul class="menu-content">
                        <li><a href="app-ecommerce-shop.html"><i class="feather icon-circle"></i><span class="menu-item"
                                    data-i18n="Shop">Shop</span></a>
                        </li>
                        <li><a href="app-ecommerce-details.html"><i class="feather icon-circle"></i><span
                                    class="menu-item" data-i18n="Details">Details</span></a>
                        </li>
                        <li><a href="app-ecommerce-wishlist.html"><i class="feather icon-circle"></i><span
                                    class="menu-item" data-i18n="Wish List">Wish List</span></a>
                        </li>
                        <li><a href="app-ecommerce-checkout.html"><i class="feather icon-circle"></i><span
                                    class="menu-item" data-i18n="Checkout">Checkout</span></a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    @yield('content')
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix blue-grey lighten-2 mb-0">
            <span class="float-md-left d-block d-md-inline-block mt-25">Copyright &copy; 2020<a
                    class="text-bold-800 grey darken-2" href="https://tivklnnotify.com" target="_blank">PT. Tirta
                    Investama</a>All rights Reserved</span>
            <span class="float-md-right d-none d-md-block">Made with<i class="feather icon-heart pink"></i></span>
            <button class="btn btn-primary btn-icon scroll-top" type="button">
                <i class="feather icon-arrow-up"></i>
            </button>
        </p>
    </footer>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->

    <script src="{{ asset('/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('/js/core/app.js') }}"></script>
    <script src="{{ asset('/js/scripts/components.js') }}"></script>
    <script src="{{ asset('/js/scripts/pages/app-chat.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('/js/scripts/extensions/sweet-alerts.js') }}"></script>
    {{-- <script src="{{ asset('/js/scripts/forms/validation/form-validation.js') }}"></script> --}}
    <!-- END: Page JS-->
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

</body>
<!-- END: Body-->

</html>
