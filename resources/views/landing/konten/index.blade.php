@extends('landing.global.index')

@section('title')
    Konten
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

        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">
                {{ $data->judul_subk }}
            </h2>
            <h3 class="h5 text-muted mb-0">
                {{ $data->judul_konten }}
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
            @if(!$gambar->isEmpty())
            <div class="block-content">
                <div class="slick_subk">
                    @foreach ($gambar as $key_array => $img)
                        <div class="pull-center">
                            <img class="img-fluid" src="{{ Storage::url($img->path_img_subk) }}" alt="Campaign">
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
            <div class="block-content block-content-full">
                {!! $data->isi_subk !!}
            </div>
        </div>


    </div>

@endsection

@push('script')
    <script type="text/javascript" src="{{ asset('js/landing/konten/index.js') }}"></script>



@endpush
