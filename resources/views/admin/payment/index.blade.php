@extends('admin.global.index')

@section('breadcrumbs')
    {{ $breadcrumbs }}
@endsection

@section('title')
    Payment
@endsection

@section('foto_header_users')
    <img src="{{ $foto_users }}" alt="" data-src="{{ $foto_users }}"
         data-src-retina="{{ $foto_users }}" width="32" height="32">
@endsection

@section('modal')
    {{ view('admin.global.partials.modal.password', ['data' => $session]) }}
    {{ view('admin.payment.modal.create', ['created_by' => $session['id_users']]) }}
    {{ view('admin.payment.modal.delete', ['created_by' => $session['id_users']]) }}
@endsection

@section('content')
    <div class=" container-fluid container-fixed-md bg-white">
        <div class="card card-transparent">
            <div class="card-header d-flex justify-content-between">
                <div class="clearfix"></div>
            </div>
            <div class="card-block">
                <div class="row clearfix">
                    <div class="col-md-3">
                        <label>
                            <h5>Display Tabel : </h5>
                        </label>
                        <select id="dt_payment_length" class="cs-select cs-skin-slide"
                                data-init-plugin="cs-select">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                        </select>
                    </div>
                    @if($composers_rules_users->payment->create == 1)
                        <div class="col-md-6">
                            <div class="form-group form-group-default input-group">
                                <div class="form-input-group">
                                    <label>Search</label>
                                    <input type="text" id="dt_payment_search" class="form-control pull-right"
                                           placeholder="Masukkan kata pencarian...">
                                </div>
                                <div class="input-group-addon">
                                    <a href="javascript:void(0)" id="dt_payment_submit">
                                        <i class="fa fa-search"></i> Submit
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 my-2">
                            <button data-toggle="modal" data-target="#modal_create_payment"
                                    class="btn btn-primary btn-cons btn-block btn-animated from-left fa fa-plus">
                                <span>Buat Jenis Pembayaran</span>
                            </button>
                        </div>
                    @else
                        <div class="col-md-9">
                            <div class="form-group form-group-default input-group">
                                <div class="form-input-group">
                                    <label>Search</label>
                                    <input type="text" id="dt_payment_search" class="form-control pull-right"
                                           placeholder="Masukkan kata pencarian...">
                                </div>
                                <div class="input-group-addon">
                                    <a href="javascript:void(0)" id="dt_payment_submit">
                                        <i class="fa fa-search"></i> Submit
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <table class="table table-striped" id="dt_payment"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('content_js')
    <script src="{{ asset('js/admin/payment/datatable_payment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/admin/payment/form_create_payment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/admin/payment/form_edit_payment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/admin/payment/modal_payment.js') }}" type="text/javascript"></script>

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
