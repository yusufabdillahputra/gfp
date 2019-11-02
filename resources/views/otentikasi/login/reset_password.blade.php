@extends('otentikasi.global.index')

@section('title')
    Ubah Password
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

                    <!-- Sign In Form -->
                    <form id="form_reset_password" action="{{ route('otentikasi.forgot.edit') }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id_users" value="{{ $id_users }}">
                        <div class="block block-themed block-rounded block-shadow">
                            <div class="block-header bg-gd-aqua">
                                <h3 class="block-title">Ubah Password</h3>
                            </div>
                            <div class="block-content">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="users_password_baru">Password</label>
                                        <input autofocus type="password" class="form-control" id="users_password_baru"
                                               name="users_password_baru" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="users_password_baru_re">Ketik Kembali Password</label>
                                        <input type="password" class="form-control" id="users_password_baru_re"
                                               name="users_password_baru_re" required>
                                    </div>
                                </div>
                            </div>
                            <div class="block-content bg-body-light">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-alt-primary btn-block">
                                        <i class="fa fa-check mr-10"></i> Rubah
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
    <script type="text/javascript">
        $(document).ready(function () {
            'use strict';

            let form_reset_password = $('#form_reset_password');
            form_reset_password.validate({
                errorClass: "invalid-feedback animated fadeInDown",
                errorElement: "div",
                errorPlacement: function (e, r) {
                    jQuery(r).parents(".form-group > div").append(e)
                },
                highlight: function (e) {
                    jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
                },
                success: function (e) {
                    jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
                },
                rules: {
                    users_password_baru: {
                        required: true,
                        minlength: 3
                    },
                    users_password_baru_re: {
                        required: true,
                        minlength: 3,
                        equalTo: "#users_password_baru"
                    }
                },
                messages: {
                    users_password_baru: {
                        required: "Masukkan password baru",
                        minlength: 'Minimal password 3 karakter'
                    },
                    users_password_baru_re: {
                        required: "Ketik kembali password baru",
                        minlength: 'Minimal password 3 karakter',
                        equalTo: 'Password baru tidak sesuai'
                    }
                }
            });

        });

    </script>
@endpush
