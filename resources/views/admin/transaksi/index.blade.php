@extends('admin.global.index')

@section('breadcrumbs')
    {{ $breadcrumbs }}
@endsection

@section('title')
    Transaksi
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
                @if($composers_rules_users->transaksi->topup->read == 1)
                <div class="col-md-4">
                    <div data-pages="card" class="card card-default mt-2" id="card-basic">
                        <div class="card-header separator">
                            <img width="200px" class="card-img-top img-fluid rounded mx-auto d-block"
                                 src="{{ asset('image/sys/dompet/top_up.png') }}" alt="Top Up">
                        </div>
                        <div class="card-block">
                            <h3>
                                <span class="semi-bold">Top Up Donatur</span>
                            </h3>
                            <p>
                                Melakukan penambahan saldo pribadi donatur.
                            </p>
                            <div class="btn-group">
                                <a href="{{ route('transaksi.topup.index') }}"
                                   class="btn btn-primary btn-cons btn-animated from-left fa fa-arrow-right">
                                    <span>List</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($composers_rules_users->transaksi->donasi->read == 1)
                <div class="col-md-4">
                    <div data-pages="card" class="card card-default mt-2" id="card-basic">
                        <div class="card-header separator">
                            <img width="200px" class="card-img-top img-fluid rounded mx-auto d-block"
                                 src="{{ asset('image/sys/dompet/transaksi.png') }}" alt="Admin">
                        </div>
                        <div class="card-block">
                            <h3>
                                <span class="semi-bold">Donasi</span>
                            </h3>
                            <p>
                                Memproses donasi donatur.
                            </p>
                            <div class="btn-group">
                                <a href="{{ route('transaksi.donasi.index') }}"
                                   class="btn btn-primary btn-cons btn-animated from-left fa fa-arrow-right">
                                    <span>List</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($composers_rules_users->transaksi->tarik->read == 1)
                <div class="col-md-4">
                    <div data-pages="card" class="card card-default mt-2" id="card-basic">
                        <div class="card-header separator">
                            <img width="200px" class="card-img-top img-fluid rounded mx-auto d-block"
                                 src="{{ asset('image/sys/dompet/penarikan.png') }}" alt="Donatur">
                        </div>
                        <div class="card-block">
                            <h3>
                                <span class="semi-bold">Penarikan Dana</span>
                            </h3>
                            <p>
                                Memproses permintaan penarikan dana oleh donatur.
                            </p>
                            <div class="btn-group">
                                <a href="{{ route('transaksi.tarik.index') }}"
                                   class="btn btn-primary btn-cons btn-animated from-left fa fa-arrow-right">
                                    <span>List</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($composers_rules_users->transaksi->kebutuhan->read == 1)
                <div class="col-md-4">
                    <div data-pages="card" class="card card-default mt-2" id="card-basic">
                        <div class="card-header separator">
                            <img width="200px" class="card-img-top img-fluid rounded mx-auto d-block"
                                 src="{{ asset('image/sys/dompet/kebutuhan.png') }}" alt="Donatur">
                        </div>
                        <div class="card-block">
                            <h3>
                                <span class="semi-bold">Kebutuhan</span>
                            </h3>
                            <p>
                                Memproses pengiriman kebutuhan oleh donatur.
                            </p>
                            <div class="btn-group">
                                <a href="{{ route('transaksi.kebutuhan.index') }}"
                                   class="btn btn-primary btn-cons btn-animated from-left fa fa-arrow-right">
                                    <span>List</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('content_js')

@endpush
