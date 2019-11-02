<div class="block block-rounded">
    <div class="block-header">
        <h3>
            Penarikan Uang
        </h3>
        <p>
            <strong>
                <i class="si si-clock"></i> {{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}
            </strong>
        </p>
    </div>
    <div class="block-content">
        <h5 class="font-size-h1 font-w300 mb-5">
            Rp. {{ number_format($data->saldo_transaksi,0,'','.') }},-
        </h5>
        <hr>
        <p>
            <i class="si si-earphones-alt text-muted mr-5"></i>
            @if($data->status_transaksi == 0)
                <span class="badge badge-pill badge-warning">Proses</span>
            @elseif($data->status_transaksi == 1)
                <span class="badge badge-pill badge-primary">Sukses</span>
            @elseif($data->status_transaksi == 2)
                <span class="badge badge-pill badge-danger">Ditolak</span>
            @elseif($data->status_transaksi == 3)
                <span class="badge badge-pill badge-important">Expired</span>
            @endif
        </p>
    </div>
</div>
