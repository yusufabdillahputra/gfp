@extends('otentikasi.global.index')

@section('title')
    Lupa Password
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
                    <form action="{{ route('otentikasi.forgot.post') }}" method="post">
                        @csrf
                        <div class="block block-themed block-rounded block-shadow">
                            <div class="block-header bg-gd-aqua">
                                <h3 class="block-title">Lupa Password</h3>
                            </div>
                            <div class="block-content">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="email_users">Email</label>
                                        <input autofocus type="email" class="form-control" id="email_users" name="email_users" required>
                                    </div>
                                </div>
                            </div>
                            <div class="block-content bg-body-light">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-alt-primary btn-block">
                                        <i class="fa fa-send mr-10"></i> Kirim
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

@endpush
