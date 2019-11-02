<div class="animated fadeIn">
    <input type="hidden" name="saldo_transaksi" value="{{ number_format(str_replace(',','',$jumlah_transaksi),0,'','') }}">
    <input type="hidden" name="id_payment" value="{{ $id_payment }}">
    <input type="hidden" name="jenis_transaksi" value="1">
    <div class="block block-rounded">
        <div class="block-header">
            <h4 class="text-center">
                <b>{{ $data->nama_bank_payment }}</b>
            </h4>
        </div>
        <div class="block-content">
            <img width="200px" class="img-fluid"
                 src="{{ Storage::url($data->logo_bank_payment) }}" alt="Top Up">
        </div>
        <div class="block-content bg-light">
            <div class="row">
                <div class="col-md-6">
                    <div class="block block-rounded">
                        <div class="block-header">
                            Atas Nama <i class="fa fa-user-circle-o"></i>
                        </div>
                        <div class="block-content">
                            <h4>{{ $data->pemilik_rek_payment }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block block-rounded">
                        <div class="block-header">
                            Nomor Rekening <i class="fa fa-address-card-o"></i>
                        </div>
                        <div class="block-content">
                            <h4>{{ $data->rekening_payment }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-content bg-light">
            <div class="block block-rounded">
                <div class="block-header">
                    Jumlah Transfer <i class="si si-wallet"></i>
                </div>
                <div class="block-content p-2 ml-2">
                    <h3><b>Rp. {{ $jumlah_transaksi }}</b></h3>
                </div>
            </div>
        </div>
        <div class="block-content bg-light">
            <h4><i class="fa fa-info-circle"></i> Cara Pembayaran</h4><br>
            {!! $data->step_payment !!}
        </div>
        <div class="block-content block-content-full clearfix bg-light">
            <div class="btn-group">
                <button class="btn btn-primary" type="submit">
                    <i class="si si-check"></i> Top Up
                </button>
                <button class="btn btn-outline-warning" type="button" onclick="window.location.reload()">
                    <i class="si si-refresh"></i> Ganti Metode Pembayaran
                </button>
            </div>
        </div>
    </div>
</div>
