@foreach($data as $kebutuhan)
    <div class="col-md-4 animated fadeIn">
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
