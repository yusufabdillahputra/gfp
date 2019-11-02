@extends('otentikasi.global.index')

@section('title')
    Login
@endsection

@section('content')
    <div class="bg-body-dark bg-pattern" style="background-image: url({{ asset('template/landing/media/various/bg-pattern-inverse.png') }});">
        <div class="row mx-0 justify-content-center">
            <div class="hero-static col-lg-6 col-xl-4">
                <div class="content content-full overflow-hidden">
                    <!-- Header -->
                    <div class="py-30 text-center">
                        <a class="font-w700" href="{{ route('landing.index') }}">
                            <img class="mr-4" width="170px" src="{{ asset('image/sys/logo.png') }}">
                        </a>
                        <h1 class="h4 font-w700 mt-30 mb-10">Selamat Datang <i class="si si-emoticon-smile"></i></h1>
                        <h2 class="h5 font-w400 text-muted mb-0">Bantu Sesama Bahagia Bersama</h2>
                    </div>
                    <!-- END Header -->
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger">
                            <i class="si si-exclamation"></i> {{ $message }}
                        </div>
                    @endif
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif
                    <!-- Sign In Form -->
                    <form id="form-login" action="{{ route('otentikasi.login') }}" method="post">
                        @csrf
                        <div class="block block-themed block-rounded block-shadow">
                            <div class="block-header
                            @if(session()->get('HTTP_Code'))
                                bg-danger
                            @elseif(session()->get('success'))
                                bg-gd-leaf
                            @else
                                bg-primary
                            @endif
                                ">
                                @if(session()->get('HTTP_Code'))
                                    <h3 class="block-title">Username / Password Anda Salah</h3>
                                @elseif(session()->get('success'))
                                    <h3 class="block-title">Pendaftaran anda berhasil, silahkan login</h3>
                                @else
                                    <h3 class="block-title">Login</h3>
                                @endif
                            </div>
                            <div class="block-content">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="username_users">Username</label>
                                        <input autofocus type="text" class="form-control" id="username_users" name="username_users" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="password_users">Password</label>
                                        <input type="password" class="form-control" id="password_users" name="password_users" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="{{ route('forgot') }}">
                                        <i class="si si-exclamation mr-5"></i> Lupa Password
                                    </a>
                                </div>
                            </div>
                            <div class="block-content bg-body-light">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-alt-primary btn-block">
                                        <i class="si si-login mr-10"></i> Login
                                    </button>
                                    <a href="{{ route('signin') }}" class="btn btn-alt-info btn-block">
                                        <i class="fa fa-user-plus mr-10"></i> Buat Akun
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END Sign In Form -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('js/otentikasi/login/form_login.js') }}" type="text/javascript"></script>
@endpush
