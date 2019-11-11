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
    <div class="container-fluid container-fixed-md">

        <div class="card card-transparent">
            <div class="card-header">
                <h2 class="text-center">
                    Total Transaksi Uang Hari Ini
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

        <div class="card card-bordered">
            <div class="card-header">
                <h2 class="text-center">
                    Top Donatur Tahun {{ date('Y') }}
                </h2>
            </div>
            <div class="card-block">
                <div class="row">
                    @foreach($top_donatur as $ranking =>$donatur)
                        <div class="col-md-3">
                            <div class="card social-card full-width">
                                <div class="card-description text-center"
                                     @if(($ranking + 1) == 1)
                                     style="background-color: goldenrod"
                                     @elseif(($ranking + 1) == 2)
                                     style="background-color: silver"
                                     @elseif(($ranking + 1) == 3)
                                     style="background-color: saddlebrown"
                                    @endif
                                >
                                    <h4
                                        @if(($ranking + 1) == 2)
                                        class="text-black"
                                        @else
                                        class="text-white"
                                        @endif
                                    >
                                        Ranking {{ $ranking+1 }}
                                    </h4>
                                </div>
                                <div class="card-content">
                                    <img alt="Top Donatur" src="{{ Storage::url($donatur->foto_users) }}">
                                </div>
                                <div class="card-footer clearfix">
                                    <p>
                                        {{ $donatur->nama_users }}
                                    </p>
                                    <p>
                                        Rp. {{ number_format($donatur->total_transaksi,0,'','.') }} ,-
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card card-bordered">
            <div class="card-header">
                <h2 class="text-center">
                    Total Donasi Per Bulan Tahun {{ date('Y') }} (Rp)
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
