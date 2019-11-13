@extends('landing.global.index')

@section('title')
    Feed
@endsection

@section('content')
    <div class="content content-full">
        @isset($session['id_users'])
            <div class="row">
                <div class="col-2 col-xs-2">
                    <a href="{{ route('landing.index') }}"
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

        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">
                {{ $data->judul_feed }}
            </h2>
            <h3 class="h5 text-muted mb-0">
                {{ $data->sub_judul_feed }}
            </h3>
        </div>

        <div class="block block-rounded block-fx-shadow">
            @if(!$src_label->isEmpty())
                <div class="block-header">
                    <p>
                        <i class="si si-tag"></i>
                        @foreach($src_label as $label)
                            <span class="badge badge-pill badge-primary">{{ $label->judul_label }}</span>
                        @endforeach
                    </p>
                </div>
            @endif
            <div class="block-content">
                <div class="slick_feed">
                    @foreach ($gambar as $key_array => $img)
                        <div class="pull-center">
                            <img class="img-fluid" src="{{ Storage::url($img->path_img_feed) }}" alt="Campaign">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="block-content bg-body-light">
                <div class="row text-center">
                    <div class="col-md-6">
                        <p>
                            <i class="fa fa-calendar-check-o"></i> {{ $data->selisih_tanggal_feed }} Hari lagi
                        </p>
                        @isset($data->talent_feed)
                            <p>
                                <i class="fa fa-user"></i> {{ $data->talent_feed }}
                            </p>
                        @endisset
                    </div>
                    <div class="col-md-6">
                        @isset($data->telp_talent_feed)
                            <p>
                                <i class="fa fa-phone"></i> {{ $data->telp_talent_feed }}
                            </p>
                        @endisset
                        @isset($data->email_talent_feed)
                            <p>
                                <i class="fa fa-envelope"></i> {{ $data->email_talent_feed }}
                            </p>
                        @endisset
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full">
                {!! $data->isi_feed !!}
            </div>
        </div>
        @isset($session['id_users'])
            <div class="block block-rounded">
                <div class="block-header">
                    <h4>Donasi</h4>
                </div>
                <div class="block-content-full">
                    <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#uang"><i class="si si-wallet"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#benda"><i class="si si-present"></i></a>
                        </li>
                    </ul>
                    <div class="block-content tab-content">
                        <div class="tab-pane active" id="uang" role="tabpanel">
                            <h4 class="font-w400">Uang</h4>
                            <hr>
                            @if($composers_saldo_dompet < $data->min_donasi_feed)
                                <div class="container container-fixed-lg">
                                    <i class="fa fa-smile-o"></i> Saldo di dompet anda tidak mencukupi untuk
                                    berpartisipasi pada feed ini.<br>
                                    <i class="fa fa-question-circle"></i> Minimal saldo untuk berpartisipasi yaitu
                                    <b>Rp {{ number_format($data->min_donasi_feed, 0, '', '.').',-' }}</b>.<br>
                                    <i class="fa fa-money"></i> Ayo top up saldo anda <a
                                        href="{{ route('dompet.topup.index') }}"><u>disini</u></a>
                                </div>
                            @else
                                <form class="js-validation-bootstrap" id="form_donasi"
                                      action="{{ route('landing.donasi.uang') }}" method="POST" autocomplete="off">
                                    @csrf
                                    <input type="hidden" name="id_feed" value="{{ $data->id_feed }}">
                                    <input type="hidden" value="{{ $session['id_users'] }}" name="created_by">
                                    <input type="hidden" id="val_saldo_transaksi" name="saldo_transaksi" required>
                                    <input type="hidden" name="jenis_transaksi" value="2">
                                    <input type="hidden" name="status_transaksi" value="1">

                                    <input type="hidden" id="val_min_donasi_feed" value="{{ $data->min_donasi_feed }}">
                                    <input type="hidden" id="val_maks_donasi_feed" value="{{ $data->max_donasi_feed }}">
                                    <input type="hidden" id="composers_saldo_dompet"
                                           value="{{ $composers_saldo_dompet }}">
                                    <input type="hidden" id="_csrf" value="{{ @csrf_token() }}">

                                    <div class="form-group">
                                        <label for="saldo_transaksi">Donasi</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    Rp.
                                                </span>
                                            </div>
                                            <input autofocus type="text" id="raw_saldo_transaksi"
                                                   name="raw_saldo_transaksi" class="form-control"
                                                   placeholder="000.000.000,-" required>
                                            <div class="input-group-prepend">
                                                <button type="button" id="btn_valid_donasi"
                                                        class="btn btn-md btn-alt-primary">
                                                    <i class="fa fa-money"></i> Submit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modal_verifi_donasi" tabindex="-1" role="dialog"
                                         aria-labelledby="modal-fadein" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="block block-themed block-transparent mb-0">
                                                    <div class="block-header bg-danger">
                                                        <h3 class="block-title">Logout</h3>
                                                        <div class="block-options">
                                                            <button type="button" class="btn-block-option"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                <i class="si si-close"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="block-content">
                                                        <h4>
                                                            Apa anda yakin dengan donasi anda ?
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" data-dismiss="modal"
                                                            class="btn btn-alt-secondary">Tidak
                                                    </button>
                                                    <button id="btn_submit_donasi_uang" type="submit"
                                                            class="btn btn-alt-primary">Ya, saya yakin
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                        <div class="tab-pane" id="benda" role="tabpanel">
                            <h4 class="font-w400">Kebutuhan</h4>
                            <hr>
                            <form class="js-validation-bootstrap" id="form_donasi_benda"
                                  action="{{ route('landing.kebutuhan.post') }}" method="POST"
                                  autocomplete="off">
                                @csrf
                                <input type="hidden" value="{{ $session['id_users'] }}" name="created_by">
                                <div class="form-group">
                                    <label class="col-12" for="id_src_donasi">Jenis</label>
                                    <div class="col-md-12">
                                        <select class="form-control" id="id_src_donasi" name="id_src_donasi" required>
                                            <option value="" selected disabled>Pilih Jenis Kebutuhan</option>
                                            @foreach($feed_donasi_bukan_uang as $kebutuhan)
                                                <option
                                                    value="{{ $kebutuhan->id_src_donasi }}">{{ $kebutuhan->nama_donasi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-12" for="jumlah_feed_satuan">Jumlah</label>
                                            <div class="col-md-12">
                                                <input type="number" class="form-control" min="0"
                                                       id="jumlah_feed_satuan" name="jumlah_feed_satuan" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-12" for="id_satuan">Satuan</label>
                                            <div class="col-md-12">
                                                <select class="form-control" id="id_satuan" name="id_satuan" required>
                                                    <option value="" selected disabled>Pilih Satuan</option>
                                                    @foreach($rsc_satuan as $satuan)
                                                        <option
                                                            value="{{ $satuan->id_satuan }}">{{ $satuan->nama_satuan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-block btn-alt-primary"><i
                                                class="fa fa-send"></i> Kirim...
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endisset

        <div class="block block-rounded">
            <div class="block-header">
                <h4>
                    Bagikan Link
                </h4>
            </div>
            <div class="block-content block-content-full">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="btn-group">
                            <div class="fb-share-button"
                                 data-href="{{ route('landing.feed').'?id='.encrypt($data->id_feed) }}"
                                 data-layout="button_count" data-size="small">
                                <a
                                    target="_blank"
                                    href="https://www.facebook.com/sharer/sharer.php?u={{ route('landing.feed').'?id='.encrypt($data->id_feed) }}&amp;src=sdkpreparse"
                                    class="fb-xfbml-parse-ignore btn btn-lg btn-circle btn-outline-primary mr-5 mb-5">
                                    <i class="fa fa-facebook-square"></i>
                                </a>
                            </div>
                            <a class="btn btn-lg btn-circle btn-outline-primary mr-5 mb-5"
                               href="whatsapp://send?text={{ route('landing.feed').'?id='.encrypt($data->id_feed) }}">
                                <i class="fa fa-whatsapp"></i>
                            </a>
                            <a target="_blank" class="btn btn-lg btn-circle btn-outline-primary mr-5 mb-5"
                               href="https://twitter.com/intent/tweet?text={{ route('landing.feed').'?id='.encrypt($data->id_feed) }}">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a target="_blank" class="btn btn-lg btn-square btn-outline-primary mr-5 mb-5"
                               href="{{ route('landing.feed.qrcode').'?id='.encrypt($data->id_feed) }}">
                                <i class="fa fa-qrcode"></i> Generate QR Code
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="block block-rounded">
            <div class="block-header">
                <h4>Daftar Donatur</h4>
            </div>
            <div class="block-content-full">
                <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#daftar_uang">
                            <i class="si si-wallet"></i>({{ $hitung_donasi_uang }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#daftar_benda">
                            <i class="si si-present"></i>({{ $hitung_donasi_kebutuhan }})
                        </a>
                    </li>
                </ul>
                <div class="block-content tab-content">
                    <div class="tab-pane active" id="daftar_uang" role="tabpanel">
                        <h4 class="font-w400">Donasi Uang</h4>
                        <hr>
                        @if(!$daftar_donasi_uang->isEmpty())
                            <div id="AJAX_list_donasi_uang" class="row">
                                @foreach($daftar_donasi_uang as $data_donasi_uang)
                                    <div class="col-12">
                                        <div class="block block-rounded bg-light">
                                            <div class="block-content">
                                                <table class="table table-borderless">
                                                    <thead>
                                                    <tr>
                                                        <td class="d-none d-sm-table-cell text-center"
                                                            style="width: 140px;">
                                                            <div class="mb-10">
                                                                <img class="img-avatar"
                                                                     src="{{ Storage::url($data_donasi_uang->foto_users) }}"
                                                                     alt="">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p>
                                                                <strong>
                                                                    {{ $data_donasi_uang->nama_users }}
                                                                </strong>
                                                            </p>
                                                            <p>
                                                                Rp. {{ number_format($data_donasi_uang->saldo_transaksi,0,'','.') }}
                                                                ,-
                                                            </p>
                                                            <hr>
                                                            <p class="font-size-sm text-muted">
                                                                <i class="si si-clock"></i> {{ \Carbon\Carbon::parse($data_donasi_uang->created_at)->diffForHumans() }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div class="block block-rounded">
                                        <div class="block-header">
                                            <input type="hidden" id="_csrf" value="{{ @csrf_token() }}">
                                            <input type="hidden" id="id_feed" value="{{ encrypt($data->id_feed) }}">
                                            <input type="hidden" id="_offset_now">
                                            <input type="hidden" id="_limit_db" value="3">
                                            <button type="button" id="btn_append_donasi_uang"
                                                    class="btn btn-block btn-alt-primary min-width-125"
                                                    data-toggle="click-ripple">
                                                Lihat Lagi..
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($daftar_donasi_uang->isEmpty())
                            <h4 class="font-w400">Belum ada donatur</h4>
                            <p>
                                Ayo ikut berpartisipasi membantu yang membutuhkan <i class="si si-emoticon-smile"></i>
                            </p>
                        @endif
                    </div>
                    <div class="tab-pane" id="daftar_benda" role="tabpanel">
                        <h4 class="font-w400">Donasi Kebutuhan</h4>
                        <hr>
                        @if(!$daftar_donasi_kebutuhan->isEmpty())
                            <div id="AJAX_list_donasi_kebutuhan" class="row">
                                @foreach($daftar_donasi_kebutuhan as $data_donasi_kebutuhan)
                                    <div class="col-12">
                                        <div class="block block-rounded bg-light">
                                            <div class="block-content">
                                                <table class="table table-borderless">
                                                    <thead>
                                                    <tr>
                                                        <td class="d-none d-sm-table-cell text-center"
                                                            style="width: 140px;">
                                                            <div class="mb-10">
                                                                <img class="img-avatar"
                                                                     src="{{ Storage::url($data_donasi_kebutuhan->foto_users) }}"
                                                                     alt="">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p>
                                                                <strong>
                                                                    {{ $data_donasi_kebutuhan->nama_users }}
                                                                </strong>
                                                            </p>
                                                            <h3>
                                                                {{ $data_donasi_kebutuhan->nama_donasi }}
                                                            </h3>
                                                            <h4>
                                                                {{ $data_donasi_kebutuhan->jumlah_feed_satuan }} {{ $data_donasi_kebutuhan->nama_satuan }}
                                                            </h4>
                                                            <hr>
                                                            <p class="font-size-sm text-muted">
                                                                <i class="si si-clock"></i> {{ \Carbon\Carbon::parse($data_donasi_kebutuhan->created_at)->diffForHumans() }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div class="block block-rounded">
                                        <div class="block-header">
                                            <input type="hidden" id="k_csrf" value="{{ @csrf_token() }}">
                                            <input type="hidden" id="k_id_feed" value="{{ encrypt($data->id_feed) }}">
                                            <input type="hidden" id="k_offset_now">
                                            <input type="hidden" id="k_limit_db" value="3">
                                            <button type="button" id="btn_append_donasi_kebutuhan"
                                                    class="btn btn-block btn-alt-primary min-width-125"
                                                    data-toggle="click-ripple">
                                                Lihat Lagi..
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($daftar_donasi_kebutuhan->isEmpty())
                            <h4 class="font-w400">Belum ada donatur</h4>
                            <p>
                                Ayo ikut berpartisipasi membantu yang membutuhkan <i class="si si-emoticon-smile"></i>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endsection

        @push('script')
            <script type="text/javascript" src="{{ asset('js/landing/main/feed/feed.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/landing/main/feed/donasi.js') }}"></script>

    @endpush
