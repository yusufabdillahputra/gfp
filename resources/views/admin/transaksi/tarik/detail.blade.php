@extends('admin.global.index')

@section('breadcrumbs')
    {{ $breadcrumbs }}
@endsection

@section('title')
    Detail | Penarikan Dana
@endsection

@section('foto_header_users')
    <img src="{{ $foto_users }}" alt="" data-src="{{ $foto_users }}"
         data-src-retina="{{ $foto_users }}" width="32" height="32">
@endsection

@section('modal')
    {{ view('admin.global.partials.modal.password', ['data' => $session]) }}
@endsection

@section('content')
    <div class="container-fluid container-fixed-md bg-white">
        <div class="card card-transparent">
            <div class="card-header d-flex justify-content-between">
                <div class="clearfix">
                    <h2>Detail Transaksi</h2>
                </div>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-md-4">
                        <div data-pages="card" class="card card-default">
                            <div class="card-header separator">
                                <h4 class="text-center">Penarikan Dana</h4>
                            </div>
                            <div class="card-block">
                                @if($data->status_transaksi !== 1)
                                    <form role="form" action="{{ route('transaksi.tarik.update') }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id_transaksi" value="{{ $data->id_transaksi }}">
                                        <input type="hidden" name="updated_by" value="{{ $session['id_users'] }}">
                                        <input type="hidden" name="saldo_transaksi" value="{{ $data->saldo_transaksi }}">
                                        <input type="hidden" name="created_by" value="{{ $data->created_by }}">
                                        <h5 class="text-center">Set Status</h5>
                                        <hr>
                                        <div class="row text-center">
                                            <div class="col-md-6">
                                                <div class="radio radio-warning">
                                                    <input
                                                        @if($data->status_transaksi == 0)
                                                        checked="checked"
                                                        @endif
                                                        type="radio" value="0" name="status_transaksi" id="proses">
                                                    <label for="proses">Proses</label>
                                                </div>
                                                <div class="radio radio-success">
                                                    <input
                                                        @if($data->status_transaksi == 1)
                                                        checked="checked"
                                                        @endif
                                                        type="radio" value="1" name="status_transaksi" id="success">
                                                    <label for="success">Sukses</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="radio radio-danger">
                                                    <input
                                                        @if($data->status_transaksi == 2)
                                                        checked="checked"
                                                        @endif
                                                        type="radio" value="2" name="status_transaksi" id="cancel">
                                                    <label for="cancel">Cancel</label>
                                                </div>
                                                <div class="radio">
                                                    <input
                                                        @if($data->status_transaksi == 3)
                                                        checked="checked"
                                                        @endif
                                                        type="radio" value="3" name="status_transaksi" id="expired">
                                                    <label for="expired">Expired</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <div data-pages="card" class="card card-default">
                                    <div class="card-header separator">
                                        <h4 class="text-center">
                                            <b>{{ $data_users['bank'] }}</b>
                                            @if($data->status_transaksi == 0)
                                                <span style="margin-top: 20px" class="label label-warning">Proses</span>
                                            @elseif($data->status_transaksi == 1)
                                                <span class="label label-success">Sukses</span>
                                            @elseif($data->status_transaksi == 2)
                                                <span class="label label-danger">Cancel</span>
                                            @elseif($data->status_transaksi == 3)
                                                <span class="label">Expired</span>
                                            @endif
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-6">
                                <div data-pages="card" class="card card-default">
                                    <div class="card-header separator">
                                        <i class="fa fa-user-circle-o"></i> Atas Nama
                                    </div>
                                    <div class="card-block">
                                        {{ $data_users['nm_rek'] }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div data-pages="card" class="card card-default">
                                    <div class="card-header separator">
                                        <i class="fa fa-address-card-o"></i> Nomor Rekening
                                    </div>
                                    <div class="card-block">
                                        {{ $data_users['rekening'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-6">
                                <div data-pages="card" class="card card-default">
                                    <div class="card-header separator">
                                        <i class="fa fa-money"></i> Request Saldo Transaksi
                                    </div>
                                    <div class="card-block">
                                        Rp. {{ number_format($data->saldo_transaksi,0,'','.') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div data-pages="card" class="card card-default">
                                    <div class="card-header separator">
                                        <i class="fa fa-clock-o"></i> Waktu Request
                                    </div>
                                    <div class="card-block">
                                        {{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('content_js')
    <script type="text/javascript">
        $(document).ready(function() {
            'use strict'

            $(window).keydown(function (event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });

        });
    </script>

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
