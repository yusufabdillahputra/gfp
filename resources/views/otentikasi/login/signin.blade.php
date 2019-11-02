@extends('otentikasi.global.index')

@section('title')
    Sign In
@endsection

@section('content')
    <div class="bg-body-dark bg-pattern"
         style="background-image: url({{ asset('template/landing/media/various/bg-pattern-inverse.png') }});">
        <div class="row mx-0 justify-content-center">
            <div class="hero-static col-lg-6 col-xl-4">
                <div class="content content-full overflow-hidden">
                    <!-- Header -->
                    <div class="py-30 text-center">
                        <a class="font-w700" href="{{ route('landing.index') }}">
                            <img class="mr-4" width="170px" src="{{ asset('image/sys/logo.png') }}">
                        </a>
                    </div>
                    <!-- END Header -->
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Sign In Form -->
                    <form id="form-signin" action="{{ route('otentikasi.signin.post') }}" method="post">
                        @csrf
                        <div class="block block-themed block-rounded block-shadow">
                            <div class="block-header bg-gd-leaf">
                                <h3 class="block-title">Daftar</h3>
                            </div>
                            <div class="block-content">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="username_users">Nama Lengkap</label>
                                        <input autofocus type="text" class="form-control" id="nama_users"
                                               name="nama_users" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="nama_users">Username</label>
                                        <input type="text" class="form-control" id="username_users"
                                               name="username_users" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="email_users">Email</label>
                                        <input autofocus type="email" class="form-control" id="email_users"
                                               name="email_users" required>
                                    </div>
                                </div>
                            </div>
                            <div class="block-content bg-body-light">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-alt-primary btn-block">
                                        <i class="fa fa-user-plus mr-10"></i> Buat Akun
                                    </button>
                                    <a href="{{ route('login') }}" class="btn btn-alt-warning btn-block">
                                        <i class="si si-arrow-left mr-10"></i> Kembali Ke Login
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
    <script src="{{ asset('js/otentikasi/login/form_signin.js') }}" type="text/javascript"></script>

@endpush
