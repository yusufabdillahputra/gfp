@extends('admin.global.index')

@section('breadcrumbs')
    {{ $breadcrumbs }}
@endsection

@section('title')
    Pengguna
@endsection

@section('foto_header_users')
    <img src="{{ $foto_users }}" alt="" data-src="{{ $foto_users }}"
         data-src-retina="{{ $foto_users }}" width="32" height="32">
@endsection

@section('modal')
    {{ view('admin.global.partials.modal.password', ['data' => $session]) }}
@endsection

@section('content')
    <div class="container-fluid container-fixed-lg bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div data-pages="card" class="card card-default mt-2" id="card-basic">
                        <div class="card-header separator">
                            <img class="card-img-top img-fluid rounded mx-auto d-block"
                                 src="{{ asset('image/sys/users/profile.png') }}" alt="Profile">
                        </div>
                        <div class="card-block">
                            <h3>
                                <span class="semi-bold">Profile</span>
                            </h3>
                            <p>
                                Melakukan pengubahan data pada profile pribadi
                                <br><br>
                            </p>
                            <div class="btn-group">
                                <a href="{{ route('users.profile.index') }}"
                                   class="btn btn-primary btn-cons btn-animated from-left fa fa-arrow-right">
                                    <span>List</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @if($composers_rules_users->users->admin->read == 1)
                    <div class="col-md-4">
                        <div data-pages="card" class="card card-default mt-2" id="card-basic">
                            <div class="card-header separator">
                                <img class="card-img-top img-fluid rounded mx-auto d-block"
                                     src="{{ asset('image/sys/users/admin.png') }}" alt="Admin">
                            </div>
                            <div class="card-block">
                                <h3>
                                    <span class="semi-bold">Admin</span>
                                </h3>
                                <p>
                                    Mengatur data admin yang terdaftar dan menambah admin yang baru
                                </p>
                                <div class="btn-group">
                                    <a href="{{ route('users.admin.index') }}"
                                       class="btn btn-primary btn-cons btn-animated from-left fa fa-arrow-right">
                                        <span>List</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if($composers_rules_users->users->donatur->read == 1)
                    <div class="col-md-4">
                        <div data-pages="card" class="card card-default mt-2" id="card-basic">
                            <div class="card-header separator">
                                <img class="card-img-top img-fluid rounded mx-auto d-block"
                                     src="{{ asset('image/sys/users/donatur.png') }}" alt="Donatur">
                            </div>
                            <div class="card-block">
                                <h3>
                                    <span class="semi-bold">Donatur</span>
                                </h3>
                                <p>
                                    Mengatur data donatur yang terdaftar dan menambah donatur yang baru
                                </p>
                                <div class="btn-group">
                                    <a href="{{ route('users.donatur.index') }}"
                                       class="btn btn-primary btn-cons btn-animated from-left fa fa-arrow-right">
                                        <span>List</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-md-4">
                    <div data-pages="card" class="card card-default mt-2" id="card-basic">
                        <div class="card-header separator">
                            <img class="card-img-top img-fluid rounded mx-auto d-block"
                                 src="{{ asset('image/sys/users/request.png') }}" alt="Request">
                        </div>
                        <div class="card-block">
                            <h3>
                                <span class="semi-bold">Request Feed</span>
                            </h3>
                            <p>
                                Pemberian akses request feed
                                <br><br>
                            </p>
                            <div class="btn-group">
                                <a href="{{ route('users.reqfeed.index') }}"
                                   class="btn btn-primary btn-cons btn-animated from-left fa fa-arrow-right">
                                    <span>List</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div data-pages="card" class="card card-default mt-2" id="card-basic">
                        <div class="card-header separator">
                            <img class="card-img-top img-fluid rounded mx-auto d-block"
                                 src="{{ asset('image/sys/users/logout.png') }}" alt="Request">
                        </div>
                        <div class="card-block">
                            <h3>
                                <span class="semi-bold">Daftar Logout</span>
                            </h3>
                            <p>
                                Daftar log pengguna yang telah logout
                                <br><br>
                            </p>
                            <div class="btn-group">
                                <a href="{{ route('users.logout.index') }}"
                                   class="btn btn-primary btn-cons btn-animated from-left fa fa-arrow-right">
                                    <span>List</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div data-pages="card" class="card card-default mt-2" id="card-basic">
                        <div class="card-header separator">
                            <img class="card-img-top img-fluid rounded mx-auto d-block"
                                 src="{{ asset('image/sys/users/login.png') }}" alt="Request">
                        </div>
                        <div class="card-block">
                            <h3>
                                <span class="semi-bold">Daftar Login</span>
                            </h3>
                            <p>
                                Daftar log pengguna yang telah login
                                <br><br>
                            </p>
                            <div class="btn-group">
                                <a href="{{ route('users.login.index') }}"
                                   class="btn btn-primary btn-cons btn-animated from-left fa fa-arrow-right">
                                    <span>List</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('content_js')
    @if ($message = Session::get('success'))
        <script type="text/javascript">
            $(document).ready(function () {
                'use strict';
                $('.page-content-wrapper').pgNotification({
                    style: 'simple',
                    message: '{{ $message }}',
                    position: 'top-right',
                    timeout: 4000,
                    type: 'success'
                }).show();
            });
        </script>
    @elseif($message = Session::get('error'))
        <script type="text/javascript">
            $(document).ready(function () {
                'use strict';
                $('.page-content-wrapper').pgNotification({
                    style: 'simple',
                    message: '{{ $message }}',
                    position: 'top-right',
                    timeout: 4000,
                    type: 'error'
                }).show();
            });
        </script>
    @endif
@endpush
