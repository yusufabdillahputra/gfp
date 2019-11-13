@extends('admin.global.index')

@section('breadcrumbs')
    {{ $breadcrumbs }}
@endsection

@section('title')
    Dashboard
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
        <h3 class="text-center">
            <br>
            <b>
                Transaksi Hari Ini
            </b>
        </h3>

        <div class="card card-transparent">
            <div class="card-header">
                <h2>
                    <u>
                        Top Up
                    </u>
                </h2>
            </div>
            <div class="card-content">
                <div class="row">
                    <div class="col-md-3">
                        <div data-pages="card" class="card card-default" id="card-basic">
                            <div class="card-header bg-warning">
                                <div class="card-title">
                                    Proses
                                </div>
                            </div>
                            <div class="card-block">
                                <h3 class="bold pull-right">
                                    {{ $transaksi_today->topup_proses }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div data-pages="card" class="card card-default" id="card-basic">
                            <div class="card-header bg-success">
                                <div class="card-title">
                                    Sukses
                                </div>
                            </div>
                            <div class="card-block">
                                <h3 class="bold pull-right">
                                    {{ $transaksi_today->topup_sukses }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div data-pages="card" class="card card-default" id="card-basic">
                            <div class="card-header bg-danger">
                                <div class="card-title text-white">
                                    Cancel
                                </div>
                            </div>
                            <div class="card-block">
                                <h3 class="bold pull-right">
                                    {{ $transaksi_today->topup_cancel }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div data-pages="card" class="card card-default" id="card-basic">
                            <div class="card-header">
                                <div class="card-title">
                                    Expired
                                </div>
                            </div>
                            <div class="card-block">
                                <h3 class="bold pull-right">
                                    {{ $transaksi_today->topup_expired }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-transparent">
            <div class="card-header">
                <h2>
                    <u>
                        Donasi
                    </u>
                </h2>
            </div>
            <div class="card-content">
                <div class="row">
                    <div class="col-md-3">
                        <div data-pages="card" class="card card-default" id="card-basic">
                            <div class="card-header bg-warning">
                                <div class="card-title">
                                    Proses
                                </div>
                            </div>
                            <div class="card-block">
                                <h3 class="bold pull-right">
                                    {{ $transaksi_today->donasi_proses }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div data-pages="card" class="card card-default" id="card-basic">
                            <div class="card-header bg-success">
                                <div class="card-title">
                                    Sukses
                                </div>
                            </div>
                            <div class="card-block">
                                <h3 class="bold pull-right">
                                    {{ $transaksi_today->donasi_sukses }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div data-pages="card" class="card card-default" id="card-basic">
                            <div class="card-header bg-danger">
                                <div class="card-title text-white">
                                    Cancel
                                </div>
                            </div>
                            <div class="card-block">
                                <h3 class="bold pull-right">
                                    {{ $transaksi_today->donasi_cancel }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div data-pages="card" class="card card-default" id="card-basic">
                            <div class="card-header">
                                <div class="card-title">
                                    Expired
                                </div>
                            </div>
                            <div class="card-block">
                                <h3 class="bold pull-right">
                                    {{ $transaksi_today->donasi_expired }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-transparent">
            <div class="card-header">
                <h2>
                    <u>
                        Penarikan Dana
                    </u>
                </h2>
            </div>
            <div class="card-content">
                <div class="row">
                    <div class="col-md-3">
                        <div data-pages="card" class="card card-default" id="card-basic">
                            <div class="card-header bg-warning">
                                <div class="card-title">
                                    Proses
                                </div>
                            </div>
                            <div class="card-block">
                                <h3 class="bold pull-right">
                                    {{ $transaksi_today->tarik_proses }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div data-pages="card" class="card card-default" id="card-basic">
                            <div class="card-header bg-success">
                                <div class="card-title">
                                    Sukses
                                </div>
                            </div>
                            <div class="card-block">
                                <h3 class="bold pull-right">
                                    {{ $transaksi_today->tarik_sukses }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div data-pages="card" class="card card-default" id="card-basic">
                            <div class="card-header bg-danger">
                                <div class="card-title text-white">
                                    Cancel
                                </div>
                            </div>
                            <div class="card-block">
                                <h3 class="bold pull-right">
                                    {{ $transaksi_today->tarik_cancel }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div data-pages="card" class="card card-default" id="card-basic">
                            <div class="card-header">
                                <div class="card-title">
                                    Expired
                                </div>
                            </div>
                            <div class="card-block">
                                <h3 class="bold pull-right">
                                    {{ $transaksi_today->tarik_expired }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-transparent">
            <div class="card-header">
                <h2>
                    <u>
                        Donasi Kebutuhan
                    </u>
                </h2>
            </div>
            <div class="card-content">
                <div class="row">
                    <div class="col-md-4">
                        <div data-pages="card" class="card card-default" id="card-basic">
                            <div class="card-header bg-warning">
                                <div class="card-title">
                                    Proses
                                </div>
                            </div>
                            <div class="card-block">
                                <h3 class="bold pull-right">
                                    {{ $transaksi_today->kebutuhan_proses }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div data-pages="card" class="card card-default" id="card-basic">
                            <div class="card-header bg-success">
                                <div class="card-title">
                                    Diterima
                                </div>
                            </div>
                            <div class="card-block">
                                <h3 class="bold pull-right">
                                    {{ $transaksi_today->kebutuhan_diterima }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div data-pages="card" class="card card-default" id="card-basic">
                            <div class="card-header bg-danger">
                                <div class="card-title text-white">
                                    Cancel
                                </div>
                            </div>
                            <div class="card-block">
                                <h3 class="bold pull-right">
                                    {{ $transaksi_today->kebutuhan_cancel }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid container-fixed-md">
        <div class="card card-transparent">
            <div class="card-header">
                <h2 class="text-center">
                    <b>
                        Total Transaksi Uang Hari Ini
                    </b>
                </h2>
            </div>
            <div class="card-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-bordered">
                            <div class="card-header">
                                <h2 class="text-center">
                                    <u>
                                        Top Up (+)
                                    </u>
                                </h2>
                            </div>
                            <div class="card-content">
                                <h3 class="text-center">
                                    Rp. {{ number_format($transaksi_topup_now, 0, '','.') }},-
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-bordered">
                            <div class="card-header">
                                <h2 class="text-center">
                                    <u>
                                        Donasi <i class="pg-extra"></i>
                                    </u>
                                </h2>
                            </div>
                            <div class="card-content">
                                <h3 class="text-center">
                                    Rp. {{ number_format($transaksi_donasi_now, 0, '','.') }},-
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-bordered">
                            <div class="card-header">
                                <h2 class="text-center">
                                    <u>
                                        Penarikan Dana (-)
                                    </u>
                                </h2>
                            </div>
                            <div class="card-content">
                                <h3 class="text-center">
                                    Rp. {{ number_format($transaksi_tarik_now, 0, '','.') }},-
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid container-fixed-md bg-white">
        <br>
        <div class="card card-bordered">
            <div class="card-header">
                <h2 class="text-center">
                    <b>
                        Total Donasi Per Bulan Tahun {{ date('Y') }} (Rp)
                    </b>
                </h2>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-md-12">
                        <div id="chart_total_donasi" class="sparkline-chart m-t-40"></div>
                    </div>
                </div>
            </div>
            <br>
        </div>

    </div>
@endsection

@push('content_js')
    <script src="{{ asset('template/admin/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/admin/dashboard/index.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            const value = [
                {{ $total_donasi->januari }},
                {{ $total_donasi->februari }},
                {{ $total_donasi->maret }},
                {{ $total_donasi->april }},
                {{ $total_donasi->mei }},
                {{ $total_donasi->juni }},
                {{ $total_donasi->juli }},
                {{ $total_donasi->agustus }},
                {{ $total_donasi->september }},
                {{ $total_donasi->oktober }},
                {{ $total_donasi->november }},
                {{ $total_donasi->desember }}
            ];
            chartTotalDonasi(value);
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
