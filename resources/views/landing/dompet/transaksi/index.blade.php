@extends('landing.global.index')

@section('title')
    Transaksi
@endsection

@section('content')
    <div class="content content-full">
        @isset($session['id_users'])
            <div class="row">
                <div class="col-2 col-xs-2">
                    <a href="{{ route('dompet.index') }}"
                       class="btn btn-rounded btn-lg btn-outline-warning text-uppercase mb-10 mt-3">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </div>
                <div class="col-10 col-xs-10">
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
                </div>
            </div>
        @endisset

        <div id="AJAX_list_transaksi" class="row">
            @foreach($data as $transaksi)
                <div class="col-md-4 invisible" data-toggle="appear">
                    <div class="block block-rounded">
                        <a href="{{ route('dompet.transaksi.detail') . '?id=' . encrypt($transaksi->id_transaksi) }}">
                            @if($transaksi->jenis_transaksi == 1)
                                <div class="block-header bg-gd-dusk">
                                    <h4 class="text-center text-white">
                                        Top Up
                                    </h4>
                                </div>
                            @elseif($transaksi->jenis_transaksi == 2)
                                <div class="block-header bg-primary">
                                    <h4 class="text-center text-white">
                                        Donasi
                                    </h4>
                                </div>
                            @elseif($transaksi->jenis_transaksi == 3)
                                <div class="block-header bg-gd-leaf">
                                    <h4 class="text-center text-white">
                                        Penarikan Dana
                                    </h4>
                                </div>
                            @endif
                        </a>
                        <div class="block-content p-0 overflow-hidden border-bottom">
                            <center>
                                <a class="img-link"
                                   href="{{ route('dompet.transaksi.detail') . '?id=' . encrypt($transaksi->id_transaksi) }}">
                                    @if($transaksi->jenis_transaksi == 2)
                                        <img width="200px" src="{{ asset('image/sys/dompet/donasi.png') }}"
                                             class="img-fluid rounded-top"
                                             alt="Donasi">
                                    @else
                                        @isset($transaksi->logo_bank_payment)
                                            <img width="200px" src="{{ Storage::url($transaksi->logo_bank_payment) }}"
                                                 class="img-fluid rounded-top"
                                                 alt="Bank">
                                        @endisset
                                        @empty($transaksi->logo_bank_payment)
                                            <img width="200px" src="{{ asset('image/sys/dompet/penarikan.png') }}"
                                                 class="img-fluid rounded-top"
                                                 alt="Bank">
                                        @endempty
                                    @endif
                                </a>
                            </center>
                        </div>
                        <div class="block-content border-bottom">
                            <h3 class="font-size-h5 mb-10">Rp. {{ number_format($transaksi->saldo_transaksi,0,'','.') }}
                                ,-</h3>
                        </div>
                        <div class="block-content block-content-full bg-light">
                            <div class="row">
                                <div class="col-12">
                                    <p>
                                        <i class="si si-clock text-muted mr-5"></i> {{ \Carbon\Carbon::parse($transaksi->created_at)->diffForHumans() }}
                                    </p>
                                </div>
                                <div class="col-12">
                                    <p>
                                        <i class="si si-earphones-alt text-muted mr-5"></i>
                                        @if($transaksi->status_transaksi == 0)
                                            <span class="badge badge-pill badge-warning">Proses</span>
                                        @elseif($transaksi->status_transaksi == 1)
                                            <span class="badge badge-pill badge-primary">Sukses</span>
                                        @elseif($transaksi->status_transaksi == 2)
                                            <span class="badge badge-pill badge-danger">Ditolak</span>
                                        @elseif($transaksi->status_transaksi == 3)
                                            <span class="badge badge-pill badge-important">Expired</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-12">
                <input type="hidden" id="_csrf" value="{{ @csrf_token() }}">
                <input type="hidden" id="_offset_now">
                <input type="hidden" id="_limit_db" value="6">
                <button type="button" id="btn_append_transaksi" class="btn btn-block btn-alt-primary min-width-125"
                        data-toggle="click-ripple">
                    Lihat Lagi..
                </button>
            </div>
        </div>

    </div>

@endsection

@push('script')
    <script src="{{ asset('js/landing/dompet/transaksi/append.js') }}" type="text/javascript"></script>


@endpush
