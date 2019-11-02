@extends('landing.global.index')

@section('title')
    Kebutuhan
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
                            <a href="{{ route('dompet.topup.index') }}"
                               class="btn btn-circle btn-outline-success pull-left">
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

        <div id="AJAX_list_kebutuhan" class="row">
            @foreach($data as $kebutuhan)
                <div class="col-md-4 invisible" data-toggle="appear">
                    <div class="block block-rounded">
                        @if(!empty($kebutuhan->judul_feed))
                            <a href="{{ route('landing.feed') . '?id=' . encrypt($kebutuhan->id_feed) }}">
                                <div class="block-header bg-gd-elegance">
                                    <h4 class="text-center text-white">
                                        Kebutuhan
                                    </h4>
                                </div>
                            </a>
                        @elseif(empty($kebutuhan->judul_feed))
                            <div class="block-header bg-gd-elegance">
                                <h4 class="text-center text-white">
                                    Kebutuhan
                                </h4>
                            </div>
                        @endif
                        <div class="block-content p-0 overflow-hidden border-bottom">
                            <center>
                                @if(!empty($kebutuhan->judul_feed))
                                    <a class="img-link"
                                       href="{{ route('landing.feed') . '?id=' . encrypt($kebutuhan->id_feed) }}">
                                        <img width="200px" src="{{ asset('image/sys/dompet/kebutuhan.png') }}"
                                             class="img-fluid rounded-top"
                                             alt="Kebutuhan">
                                    </a>
                                @elseif(empty($kebutuhan->judul_feed))
                                    <img width="200px" src="{{ asset('image/sys/dompet/kebutuhan.png') }}"
                                         class="img-fluid rounded-top"
                                         alt="Kebutuhan">
                                @endif
                            </center>
                        </div>
                        <div class="block-content border-bottom">
                            <h3 class="font-size-h5 mb-10">
                                {{ $kebutuhan->nama_donasi }} {{ $kebutuhan->jumlah_feed_satuan }} {{ $kebutuhan->nama_satuan }}
                            </h3>
                        </div>
                        <div class="block-content block-content-full bg-light">
                            <div class="row">
                                <div class="col-12">
                                    @if(!empty($kebutuhan->judul_feed))
                                    <p>
                                        <a href="{{ route('landing.feed') . '?id=' . encrypt($kebutuhan->id_feed) }}">
                                            <i class="si si-present text-muted mr-5"></i> {{ $kebutuhan->judul_feed }}
                                        </a>
                                    </p>
                                    @elseif(empty($kebutuhan->judul_feed))
                                    <p class="text-warning">
                                        <i class="si si-exclamation text-warning mr-5"></i> Feed telah berakhir
                                    </p>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <p>
                                        <i class="si si-clock text-muted mr-5"></i> {{ \Carbon\Carbon::parse($kebutuhan->created_at)->diffForHumans() }}
                                    </p>
                                </div>
                                <div class="col-12">
                                    <p>
                                        <i class="si si-earphones-alt text-muted mr-5"></i>
                                        @if($kebutuhan->status_feed_donasi == 0)
                                            <span class="badge badge-pill badge-danger">403 | Forbidden</span>
                                        @elseif($kebutuhan->status_feed_donasi == 1)
                                            <span class="badge badge-pill badge-warning">Proses</span>
                                        @elseif($kebutuhan->status_feed_donasi == 2)
                                            <span class="badge badge-pill badge-primary">Diterima</span>
                                        @elseif($kebutuhan->status_feed_donasi == 3)
                                            <span class="badge badge-pill badge-important">Ditolak</span>
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
                <button type="button" id="btn_append_kebutuhan" class="btn btn-block btn-alt-primary min-width-125"
                        data-toggle="click-ripple">
                    Lihat Lagi..
                </button>
            </div>
        </div>

    </div>

@endsection

@push('script')
    <script src="{{ asset('js/landing/dompet/kebutuhan/append.js') }}" type="text/javascript"></script>

@endpush
