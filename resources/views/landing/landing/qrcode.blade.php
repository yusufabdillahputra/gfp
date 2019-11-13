@extends('otentikasi.global.index')

@section('title')
    QR Code
@endsection

@section('content')
    <div class="bg-body-dark bg-pattern" style="background-image: url({{ asset('template/landing/media/various/bg-pattern-inverse.png') }});">
        <div class="row mx-0 justify-content-center">
            <div class="hero-static col-lg-6 col-xl-4">
                <div class="content content-full overflow-hidden">
                    <!-- Header -->
                    <div class="py-30 text-center">
                        <a class="font-w700" href="{{ route('landing.index') }}">
                            <img class="mr-4" width="170px" src="{{ asset('image/sys/logo.png') }}">
                        </a>
                    </div>
                    <!-- END Header -->

                    <div class="block block-rounded">
                        <div class="block-content block-content-full border-bottom">
                            <center>
                                {!! DNS2D::getBarcodeHTML($link, "QRCODE", 6, 6) !!}
                            </center>
                        </div>
                        <div class="block-content block-content-full text-center">
                            Scan QRCode
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush
