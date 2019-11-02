@extends('admin.global.index')

@section('breadcrumbs')
    {{ $breadcrumbs }}
@endsection

@section('title')
    Payment | Edit
@endsection

@section('foto_header_users')
    <img src="{{ $foto_users }}" alt="" data-src="{{ $foto_users }}"
         data-src-retina="{{ $foto_users }}" width="32" height="32">
@endsection

@section('modal')
    {{ view('admin.global.partials.modal.password', ['data' => $session]) }}
    {{ view('admin.payment.modal.upload', ['id_payment' => $data->id_payment]) }}
@endsection

@section('content')
    <div class=" container-fluid container-fixed-md bg-white">
        <div class="row">
            <div class="col-md-4">
                <!-- START card -->
                <div class="row my-md-2">
                    <div class="col-md-12">
                        <a href="{{ route('payment.index') }}" class="btn btn-warning btn-cons btn-block btn-animated from-left fa fa-arrow-left mt-2"><span>Kembali</span></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <div class="card-title">
                                    Logo Bank
                                </div>
                            </div>
                            <div class="card-block">
                                <img src="{{ Storage::url($data->logo_bank_payment) }}"
                                     class="img-fluid rounded mx-auto d-block"
                                     alt="Logo Bank">
                                <hr>
                                <div class="pull-right">
                                    <a href="#modal_upload_payment" data-toggle="modal" class="btn btn-primary">Ubah Gambar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END card -->
            </div>
            <div class="col-md-8">
                <!-- START card -->
                <div class="card card-transparent">
                    <div class="card-block">
                        <form method="POST" id="form_edit_payment" action="{{ route('payment.edit') }}"
                              role="form" autocomplete="off">
                            @method('PUT')
                            @csrf
                            <input type="hidden" value="{{ $data->id_payment }}" name="id_payment">
                            <input type="hidden" value="{{ $session['id_users'] }}" name="updated_by">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default required">
                                        <label>Nama Bank</label>
                                        <input type="text" class="form-control" value="{{ $data->nama_bank_payment }}"
                                               name="nama_bank_payment" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default required">
                                        <label>Nomor Rekening</label>
                                        <input type="text" class="form-control" value="{{ $data->rekening_payment }}"
                                               name="rekening_payment" placeholder="...." required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default required">
                                        <label>Rekening Atas Nama</label>
                                        <input type="text" class="form-control" value="{{ $data->pemilik_rek_payment }}"
                                               name="pemilik_rek_payment" placeholder="......." required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Jenis Pembayaran</label>
                                <div class="col-md-9">
                                    <div class="radio radio-success">
                                        <input
                                            @if($data->jenis_payment == 1)
                                            checked="checked"
                                            @endif
                                            type="radio" value="1" name="jenis_payment" id="transfer">
                                        <label for="transfer">Transfer</label>
                                        <input
                                            @if($data->jenis_payment == 2)
                                            checked="checked"
                                            @endif
                                            type="radio" value="2" name="jenis_payment" id="virtual">
                                        <label for="virtual">Virtual Account</label>
                                        <input
                                            @if($data->jenis_payment == 3)
                                            checked="checked"
                                            @endif
                                            type="radio" value="3" name="jenis_payment" id="all">
                                        <label for="all">Transfer All Bank</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-12 control-label">Tata Cara Pembayaran</label>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="summernote-wrapper">
                                        <textarea id="editor_step_payment">{{ $data->step_payment }}</textarea>
                                    </div>
                                    <textarea id="val_step_payment" name="step_payment" style="display: none"></textarea>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr>
                            <button class="btn btn-primary" id="btn_submit" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
                <!-- END card -->
            </div>
        </div>
    </div>
@endsection

@push('content_js')
    <script src="{{ asset('js/admin/payment/dropzone_payment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/admin/payment/form_edit_payment.js') }}" type="text/javascript"></script>

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
