@extends('landing.global.index')

@section('title')
    Dompet
@endsection

@section('content')
    <div class="content content-full">
        @isset($session['id_users'])
            <div class="block block-rounded">
                <div class="block-header">
                    <a href="{{ route('dompet.topup.index') }}" class="btn btn-circle btn-outline-success pull-left">
                        <i class="si si-wallet"></i>
                    </a>
                    <span class="pull-center">
                                Rp. {{ number_format($composers_saldo_dompet,0,'','.') }},-
                            </span>

                </div>
            </div>
        @endisset

        <div class="row">
            <div class="col-md-3 animation fadeIn" data-toggle="appear">
                <div class="block block-rounded">
                    <div class="block-content p-0 overflow-hidden">
                        <a class="img-link" href="{{ route('dompet.topup.index') }}">
                            <img src="{{ asset('image/sys/dompet/top_up.png') }}"
                                 class="img-fluid rounded-top"
                                 alt="Top Up">
                        </a>
                    </div>
                    <div class="block-content border-bottom">
                        <h4 class="font-size-h5 mb-10">Top Up Dompet</h4>
                        <p class="text-muted">
                            Melakukan penambahan saldo pribadi anda.
                        </p>
                    </div>
                    <div class="block-content block-content-full">
                        <a class="btn btn-sm btn-hero btn-noborder btn-primary btn-block"
                           href="{{ route('dompet.topup.index') }}">
                            Top Up
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 animation fadeIn" data-toggle="appear">
                <div class="block block-rounded">
                    <div class="block-content p-0 overflow-hidden">
                        <a class="img-link" href="{{ route('dompet.transaksi.index') }}">
                            <img src="{{ asset('image/sys/dompet/transaksi.png') }}"
                                 class="img-fluid rounded-top"
                                 alt="Transaksi">
                        </a>
                    </div>
                    <div class="block-content border-bottom">
                        <h4 class="font-size-h5 mb-10">Transaksi</h4>
                        <p class="text-muted">
                            History transaksi pembayaran anda.
                        </p>
                    </div>
                    <div class="block-content block-content-full">
                        <a class="btn btn-sm btn-hero btn-noborder btn-primary btn-block"
                           href="{{ route('dompet.transaksi.index') }}">
                           Lihat
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 animation fadeIn" data-toggle="appear">
                <div class="block block-rounded">
                    <div class="block-content p-0 overflow-hidden">
                        <a class="img-link" href="{{ route('dompet.kebutuhan.index') }}">
                            <img src="{{ asset('image/sys/dompet/kebutuhan.png') }}"
                                 class="img-fluid rounded-top"
                                 alt="Kebutuhan">
                        </a>
                    </div>
                    <div class="block-content border-bottom">
                        <h4 class="font-size-h5 mb-10">Kebutuhan</h4>
                        <p class="text-muted">
                            Transaksi kebutuhan yang anda donasikan.
                        </p>
                    </div>
                    <div class="block-content block-content-full">
                        <a class="btn btn-sm btn-hero btn-noborder btn-primary btn-block"
                           href="{{ route('dompet.kebutuhan.index') }}">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 animation fadeIn" data-toggle="appear">
                <div class="block block-rounded">
                    <div class="block-content p-0 overflow-hidden">
                        <a class="img-link" href="{{ route('dompet.penarikan.index') }}">
                            <img src="{{ asset('image/sys/dompet/penarikan.png') }}"
                                 class="img-fluid rounded-top"
                                 alt="Top Up">
                        </a>
                    </div>
                    <div class="block-content border-bottom">
                        <h4 class="font-size-h5 mb-10">Penarikan Dana</h4>
                        <p class="text-muted">
                            Melakukan penarikan dana saldo yang tersedia.
                        </p>
                    </div>
                    <div class="block-content block-content-full">
                        <a class="btn btn-sm btn-hero btn-noborder btn-primary btn-block"
                           href="{{ route('dompet.penarikan.index') }}">
                            Tarik Dana
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script')

@endpush
