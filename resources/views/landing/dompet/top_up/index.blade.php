@extends('landing.global.index')

@section('title')
    Transaksi
@endsection

@section('content')
    <div class="content content-full">
        @isset($session['id_users'])
            <div class="row">
                <div class="col-2 col-xs-2">
                    <a href="{{ route('dompet.index') }}" class="btn btn-rounded btn-lg btn-outline-warning text-uppercase mb-10 mt-3">
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

        <div class="block block-rounded">
            <div class="block-header">
                <h4><i class="si si-wallet"></i> Top Up Dompet</h4>
            </div>
            <div class="block-content block-content-full">
                <form class="js-validation-bootstrap" id="form_topup" action="{{ route('dompet.topup.edit') }}" method="POST" role="form" autocomplete="off">
                    @csrf
                    <input type="hidden" id="_csrf" value="{{ @csrf_token() }}">
                    <input type="hidden" value="{{ $session['id_users'] }}" name="created_by">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="saldo_transaksi">Saldo Top Up</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Rp.
                                        </span>
                                    </div>
                                    <input autofocus type="text" id="saldo_transaksi" name="raw_saldo_transaksi" class="form-control" placeholder="000.000.000,-" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id_payment">Jenis Pembayaran</label>
                                <select class="form-control" id="jenis_payment" name="jenis_payment" style="width: 100%;">
                                    <option selected>Pilih Jenis Pembayaran</option>
                                    <option value="1">Transfer</option>
                                    <option value="2">Virtual Account</option>
                                    <option value="3">All Bank</option>
                                </select>
                            </div>
                            <div id="AJAX_BankPayment"></div>
                        </div>
                        <div class="col-md-8">
                            <div id="AJAX_StepPayment"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript" src="{{ asset('js/landing/dompet/topup/form_topup.js') }}"></script>
@endpush
