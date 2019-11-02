@extends('admin.global.index')

@section('breadcrumbs')
    {{ $breadcrumbs }}
@endsection

@section('title')
    Detail | Kebutuhan
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
        <div class="row">
            <div class="col-3">
                <a href="{{ route('transaksi.kebutuhan.index') }}"
                   class="btn btn-warning btn-cons btn-block btn-animated from-left fa fa-arrow-left mt-2"><span>Kembali</span></a>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="container-fluid container-fixed-md bg-white">
        <div class="card card-bordered">
            <div class="card-header d-flex justify-content-center">
                <div class="clearfix">
                    <h2>Detail Donasi Kebutuhan</h2>
                </div>
            </div>
            <div class="card-block">
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <center>
                            <img
                                class="img-thumbnail"
                                width="200"
                                height="200"
                                data-src-retina="{{ Storage::url($data->foto_users) }}"
                                data-src="{{ Storage::url($data->foto_users) }}"
                                src="{{ Storage::url($data->foto_users) }}"
                                alt="Donatur"
                            >
                        </center>
                    </div>
                    <div class="col-md-9">
                        @isset($data->judul_feed)
                            <a href="{{ route('feed.form')."?id=".encrypt($data->id_feed) }}">
                                <h4 class="text-black"><b>{{ $data->judul_feed }}</b></h4>
                            </a>
                        @endisset
                        @empty($data->judul_feed)
                            <h4 class="text-warning-dark">
                                <i class="fa fa-exclamation-triangle"></i> Judul kosong atau feed telah
                                dihapus...
                            </h4>
                        @endempty
                        <br>
                        <h3>
                            {{ $data->jumlah_feed_satuan }} {{ $data->nama_donasi }} {{ $data->nama_satuan }}
                        </h3>
                        <hr>
                        <h5>
                            @isset($data->telp_users)
                                <i class="fa fa-phone"></i> {{ $data->telp_users }} <br>
                            @endisset
                            <i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}
                            <br>
                            <i class="fa fa-check-circle"></i>
                            @if($data->status_feed_donasi == 0)
                                <span class="label label-danger">403 | Forbidden</span>
                            @elseif($data->status_feed_donasi == 1)
                                <span class="label label-warning">Proses</span>
                            @elseif($data->status_feed_donasi == 2)
                                <span class="label label-success">Diterima</span>
                            @elseif($data->status_feed_donasi == 3)
                                <span class="label label-danger">Cancel</span>
                            @endif
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('content_js')

@endpush
