@extends('admin.global.index')

@section('breadcrumbs')
    {{ $breadcrumbs }}
@endsection

@section('title')
    Pengguna | Logout
@endsection

@section('foto_header_users')
    <img src="{{ $foto_users }}" alt="" data-src="{{ $foto_users }}"
         data-src-retina="{{ $foto_users }}" width="32" height="32">
@endsection

@section('modal')
    {{ view('admin.global.partials.modal.password', ['data' => $session]) }}
@endsection

@section('content')
    <div class=" container-fluid container-fixed-md bg-white">
        <div class="card card-transparent">
            <div class="card-header d-flex justify-content-between">
                <h2 class="card-title">
                    Daftar Logout
                </h2>
            </div>
            <div class="card-block">
                <div class="row clearfix">
                    <div class="col-md-2">
                        <a href="{{ route('users.index') }}" class="btn btn-warning btn-cons btn-block btn-animated from-left fa fa-arrow-left mt-2"><span>Kembali</span></a>
                    </div>
                    <div class="col-md-3">
                        <label>
                            <h5>Display Tabel : </h5>
                        </label>
                        <select id="dt_logout_length" class="cs-select cs-skin-slide"
                                data-init-plugin="cs-select">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                        </select>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group form-group-default input-group">
                            <div class="form-input-group">
                                <label>Search</label>
                                <input type="text" id="dt_logout_search" class="form-control pull-right"
                                       placeholder="Masukkan kata pencarian...">
                            </div>
                            <div class="input-group-addon">
                                <a href="javascript:void(0)" id="dt_logout_submit">
                                    <i class="fa fa-search"></i> Submit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <table class="table table-striped" id="dt_logout"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('content_js')
    <script src="{{ asset('js/admin/users/log/datatable_logout.js') }}" type="text/javascript"></script>


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
