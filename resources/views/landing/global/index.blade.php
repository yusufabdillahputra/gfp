<!doctype html>
<html lang="en" class="no-focus">
{{ view('landing.global.partials.head') }}
<body>
<div id="page-container" class="sidebar-inverse side-scroll page-header-fixed page-header-inverse main-content-boxed">

    <!-- Sidebar -->
    <nav id="sidebar">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Side Header -->
            <div class="content-header content-header-fullrow bg-black-op-10">
                <div class="content-header-section text-center align-parent">
                    <!-- Close Sidebar, Visible only on mobile screens -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                        <i class="fa fa-times text-danger"></i>
                    </button>
                    <!-- END Close Sidebar -->

                    <!-- Logo -->
                    <div class="content-header-item">
                        <a href="{{ route('landing.index') }}">
                            <img width="85px" src="{{ asset('image/sys/logo_white.png') }}">
                        </a>
                    </div>
                    <!-- END Logo -->
                </div>
            </div>
            <!-- END Side Header -->

            <!-- Side Main Navigation -->
            <div class="content-side content-side-full">
                {{ view('landing.global.partials.menu_mobile') }}
            </div>
            <!-- END Side Main Navigation -->
        </div>
        <!-- Sidebar Content -->
    </nav>
    <!-- END Sidebar -->

    <!-- Header -->
    <header id="page-header" class="bg-primary">
        <!-- Header Content -->
        <div class="content-header">
            <!-- Left Section -->
            <div class="content-header-section">
                <!-- Logo -->
                <div class="content-header-item">
                    <a class="mr-5" href="{{ route('landing.index') }}">
                        <img class="mr-4" width="85px" src="{{ asset('image/sys/logo_white.png') }}">
                    </a>
                </div>
                <!-- END Logo -->
                {{ view('landing.global.partials.menu') }}
            </div>
            <!-- END Left Section -->

            <!-- Middle Section -->
            <div class="content-header-section d-none d-lg-block"></div>
            <!-- END Middle Section -->

            <!-- Right Section -->
            <div class="content-header-section">
                <!-- Color Themes + A few of the many header options (used just for demonstration) -->
                <!-- Themes functionality initialized in Template._uiHandleTheme() -->
                {{--
                <div class="btn-group ml-5" role="group">
                    <button type="button" class="btn btn-circle btn-dual-secondary" id="page-header-themes-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-paint-brush"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right min-width-150" aria-labelledby="page-header-themes-dropdown">
                        <h6 class="dropdown-header text-center">Color Themes</h6>
                        <div class="row no-gutters text-center">
                            <div class="col-4 mb-5">
                                <a class="text-default" data-toggle="theme" data-theme="default" href="javascript:void(0)">
                                    <i class="fa fa-2x fa-circle"></i>
                                </a>
                            </div>
                            <div class="col-4 mb-5">
                                <a class="text-elegance" data-toggle="theme" data-theme="{{ asset('template/landing/css/themes/elegance.css') }}" href="javascript:void(0)">
                                    <i class="fa fa-2x fa-circle"></i>
                                </a>
                            </div>
                            <div class="col-4 mb-5">
                                <a class="text-pulse" data-toggle="theme" data-theme="{{ asset('template/landing/css/themes/pulse.css') }}" href="javascript:void(0)">
                                    <i class="fa fa-2x fa-circle"></i>
                                </a>
                            </div>
                            <div class="col-4 mb-5">
                                <a class="text-flat" data-toggle="theme" data-theme="{{ asset('template/landing/css/themes/flat.css') }}" href="javascript:void(0)">
                                    <i class="fa fa-2x fa-circle"></i>
                                </a>
                            </div>
                            <div class="col-4 mb-5">
                                <a class="text-corporate" data-toggle="theme" data-theme="{{ asset('template/landing/css/themes/corporate.css') }}" href="javascript:void(0)">
                                    <i class="fa fa-2x fa-circle"></i>
                                </a>
                            </div>
                            <div class="col-4 mb-5">
                                <a class="text-earth" data-toggle="theme" data-theme="{{ asset('template/landing/css/themes/earth.css') }}" href="javascript:void(0)">
                                    <i class="fa fa-2x fa-circle"></i>
                                </a>
                            </div>
                        </div>
                        <h6 class="dropdown-header text-center">Header</h6>
                        <button type="button" class="btn btn-sm btn-block btn-alt-secondary" data-toggle="layout" data-action="header_fixed_toggle">Fixed Mode</button>
                        <button type="button" class="btn btn-sm btn-block btn-alt-secondary mb-10" data-toggle="layout" data-action="header_style_inverse_toggle">Style</button>
                        <div class="dropdown-divider"></div>
                    </div>
                </div>
                --}}
                <!-- END Color Themes + A few of the many header options -->

                @if(isset($session['id_users']))
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user d-sm-none"></i>
                            <span class="d-none d-sm-inline-block">{{ $session['nama_users'] }}</span>
                            <i class="fa fa-angle-down ml-5"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right min-width-200" aria-labelledby="page-header-user-dropdown">
                            <a class="dropdown-item" href="{{ route('frontend.profile.index') }}">
                                <i class="si si-user mr-5"></i> Profile
                            </a>
                            <a href="#modal_ganti_password" data-toggle="modal" class="dropdown-item">
                                <i class="fa fa-key"></i> Ganti Password
                            </a>
                            @if($composers_rules_users->backend->read == true)
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('dashboard.index') }}" class="dropdown-item">
                                    <i class="fa fa-gears"></i> Backend
                                </a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#modal_logout" data-toggle="modal">
                                <i class="si si-logout mr-5"></i> Logout
                            </a>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-circle btn-dual-secondary"><i class="fa fa-sign-in"></i></a>
                @endif

                <!-- Toggle Sidebar -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                @if(isset($session['id_users']))
                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                    <i class="fa fa-navicon"></i>
                </button>
                @endif
                <!-- END Toggle Sidebar -->
            </div>
            <!-- END Right Section -->
        </div>
        <!-- END Header Content -->

        <!-- Header Search -->
        <div id="page-header-search" class="overlay-header">
            <div class="content-header content-header-fullrow">
                <form action="bd_search.html" method="post">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <!-- Close Search Section -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <button type="button" class="btn btn-secondary px-15" data-toggle="layout" data-action="header_search_off">
                                <i class="fa fa-times"></i>
                            </button>
                            <!-- END Close Search Section -->
                        </div>
                        <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary px-15">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Header Search -->

        <!-- Header Loader -->
        <!-- Please check out the Activity page under Elements category to see examples of showing/hiding it -->
        <div id="page-header-loader" class="overlay-header bg-primary">
            <div class="content-header content-header-fullrow text-center">
                <div class="content-header-item">
                    <i class="fa fa-sun-o fa-spin text-white"></i>
                </div>
            </div>
        </div>
        <!-- END Header Loader -->
    </header>
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        @yield('content')
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
    {{ view('landing.global.partials.footer') }}
    <!-- END Footer -->
    @isset($session)
    {{ view('landing.global.modal.password', ['data' => $session]) }}
    {{ view('landing.global.modal.logout') }}
    @endisset
    @yield('modal')

</div>
{{ view('landing.global.partials.script') }}
</body>
</html>
