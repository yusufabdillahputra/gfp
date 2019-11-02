@extends('landing.global.index')

@section('title')
    Top Up
@endsection

@section('content')
    <div class="content content-full">
        @isset($session['id_users'])
            <div class="row">
                <div class="col-2 col-xs-2">
                    <a href="{{ route('dompet.transaksi.index') }}"
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

        @if($data->jenis_transaksi == 1)
            {{ view('landing.dompet.transaksi.detail.top_up', ['data' => $data]) }}
        @elseif($data->jenis_transaksi == 2)
            {{ view('landing.dompet.transaksi.detail.donasi', ['data' => $data]) }}
        @elseif($data->jenis_transaksi == 3)
            {{ view('landing.dompet.transaksi.detail.penarikan', ['data' => $data]) }}
        @endif

    </div>
@endsection

@push('script')

@endpush
