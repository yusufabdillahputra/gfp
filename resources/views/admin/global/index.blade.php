<!DOCTYPE html>
<html>
@php
    print view('admin.global.partials.head');
@endphp

<body class="fixed-header menu-pin">
<nav class="page-sidebar" data-pages="sidebar">
    <!-- BEGIN SIDEBAR MENU HEADER-->
    <div class="sidebar-header">
        <img src="{{ asset('image/sys/logo_white.png') }}" alt="logo" class="brand"
             data-src="{{ asset('image/sys/logo_white.png') }}"
             data-src-retina="{{ asset('image/sys/logo_white.png') }}" width="85px">
        <div class="sidebar-header-controls">
            <button type="button" class="btn btn-link hidden-sm-down ml-md-5" data-toggle-pin="sidebar">
                <i class="fa fs-12"></i>
            </button>
        </div>
    </div>
    <!-- END SIDEBAR MENU HEADER-->
    <!-- START SIDEBAR MENU -->
    <div class="sidebar-menu">
        <!-- BEGIN SIDEBAR MENU ITEMS-->
        @php
            print view('admin.global.partials.menu');
        @endphp
        <div class="clearfix"></div>
    </div>
    <!-- END SIDEBAR MENU -->
</nav>

<div class="page-container">
    <!-- START PAGE HEADER WRAPPER -->
    <!-- START HEADER -->
    <div class="header">
        <!-- START MOBILE SIDEBAR TOGGLE -->
        <a href="#" class="btn-link toggle-sidebar hidden-lg-up pg pg-menu" data-toggle="sidebar">
        </a>
        <!-- END MOBILE SIDEBAR TOGGLE -->
        <div class="">
            <div class="brand inline">
                <img src="{{ asset('image/sys/logo.png') }}" alt="logo"
                     data-src="{{ asset('image/sys/logo.png') }}"
                     data-src-retina="{{ asset('image/sys/logo.png') }}" width="85px">
            </div>
        </div>

        <div class="header-icon d-flex align-items-center">
            <!-- START User Info-->
            <div class="dropdown pull-right">
                <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
            <span class="thumbnail-wrapper d32 circular inline sm-m-r-5">
                @yield('foto_header_users')
            </span>
                </button>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
                    <a href="{{ route('users.profile.index') }}" class="dropdown-item"><i class="fa fa-user"></i>
                        Profile</a>
                    <a href="#modal_ganti_password" data-toggle="modal" class="dropdown-item"><i class="fa fa-key"></i>
                        Ganti Password</a>
                    <a href="#modal_logout" data-toggle="modal" class="clearfix bg-master-lighter dropdown-item">
                        <span class="pull-left">Logout</span>
                        <span class="pull-right"><i class="pg-power"></i></span>
                    </a>
                </div>
            </div>
            <!-- END User Info-->
        </div>
    </div>
    <!-- END HEADER -->
    <!-- END PAGE HEADER WRAPPER -->
    <!-- START PAGE CONTENT WRAPPER -->
    <div class="page-content-wrapper">
        <!-- START PAGE CONTENT -->
        <div class="content">
            <div class="container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
                <div class="inner">
                    <!-- START BREADCRUMB -->
                @yield('breadcrumbs')
                <!-- END BREADCRUMB -->
                </div>
            </div>
            <!-- END JUMBOTRON -->
            {{ view('admin.global.partials.modal.logout') }}
            <!-- BEGIN PlACE PAGE CONTENT HERE -->
            @yield('content')
            <!-- END PLACE PAGE CONTENT HERE -->
            @yield('modal')
        </div>
        <!-- END PAGE CONTENT -->
        <!-- START FOOTER -->
        <div class="container-fluid container-fixed-lg footer">
            <div class="copyright sm-text-center">
                <p class="small no-margin pull-left sm-pull-reset">
                    <span class="hint-text">Build @ 2019 by</span>
                    <span class="font-montserrat">Yusuf Abdillah Putra</span>
                </p>
                <p class="small no-margin pull-right sm-pull-reset">
                    <a href="#">Status</a>
                    <span class="hint-text">in development</span>
                </p>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- END FOOTER -->
    </div>
    <!-- END PAGE CONTENT WRAPPER -->
</div>
@php
    print view('admin.global.partials.script');
@endphp
</body>

</html>
