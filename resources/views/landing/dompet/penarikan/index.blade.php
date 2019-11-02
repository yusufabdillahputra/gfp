@extends('landing.global.index')

@section('title')
    Penarikan Dana
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

        <form class="js-validation-bootstrap" id="form_penarikan" action="{{ route('dompet.penarikan.create') }}" method="POST" role="form" autocomplete="off">
            @csrf
            <input type="hidden" value="{{ $session['id_users'] }}" name="created_by">
            <input type="hidden" name="jenis_transaksi" value="3">
            <input type="hidden" id="composers_saldo_dompet" value="{{ $composers_saldo_dompet }}">
            <input type="hidden" name="saldo_transaksi" id="val_saldo_transaksi">
            <input type="hidden" id="valid_nama_bank" value="{{ $data_users['bank'] }}">
            <input type="hidden" id="valid_rekening" value="{{ $data_users['rekening'] }}">
            <input type="hidden" id="valid_nm_rek" value="{{ $data_users['nm_rek'] }}">

            <div class="block block-rounded">
                <div class="block-header">
                    <h4><i class="fa fa-money"></i> Penarikan Dana</h4>
                </div>
                <div class="block-content block-content-full">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                        <span class="input-group-text">
                            Rp.
                        </span>
                            </div>
                            <input autofocus type="text" id="raw_saldo_transaksi" name="raw_saldo_transaksi" class="form-control" placeholder="000.000.000,-" required>
                            <div class="input-group-prepend">
                                <button class="btn btn-primary input-group-btn" type="submit">
                                    Tarik
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block block-rounded">
                <div class="block-header">
                    <h4><i class="fa fa-bank"></i> Bank</h4>
                </div>
                <div class="block-content">
                    @if(empty($data_users['bank']))
                        <p class="text-warning-dark">
                            <i class="fa fa-info-circle"></i> Silahkan isi terdahulu nama bank
                            di form profile anda.<br>
                            <i class="fa fa-exclamation-triangle"></i> Apabila nama bank kosong,
                            penarikan dana tidak bisa dilakukan.
                        </p>
                    @else
                        <h5>
                            {{ $data_users['bank'] }}
                        </h5>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="block block-rounded">
                        <div class="block-header">
                            <h4><i class="fa fa-user-circle-o"></i> Atas Nama</h4>
                        </div>
                        <div class="block-content">
                            @if(empty($data_users['nm_rek']))
                                <p class="text-warning-dark">
                                    <i class="fa fa-info-circle"></i> Silahkan isi terdahulu atas nama
                                    rekening di form profile anda.<br>
                                    <i class="fa fa-exclamation-triangle"></i> Apabila atas nama
                                    rekening bank kosong, penarikan dana tidak bisa dilakukan.
                                </p>
                            @else
                                <h5>{{ $data_users['nm_rek'] }}</h5>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block block-rounded">
                        <div class="block-header">
                            <h4><i class="fa fa-address-card-o"></i> Nomor Rekening</h4>
                        </div>
                        <div class="block-content">
                            @if(empty($data_users['nm_rek']))
                                <p class="text-warning-dark">
                                    <i class="fa fa-info-circle"></i> Silahkan isi terdahulu nomor
                                    rekening di form profile anda.<br>
                                    <i class="fa fa-exclamation-triangle"></i> Apabila nomor rekening
                                    bank kosong, penarikan dana tidak bisa dilakukan.
                                </p>
                            @else
                                <h5>{{ $data_users['rekening'] }}</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script type="text/javascript" src="{{ asset('js/landing/dompet/penarikan/form_penarikan.js') }}"></script>

@endpush
