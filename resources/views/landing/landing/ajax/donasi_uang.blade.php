@foreach($daftar_donasi_uang as $data_donasi_uang)
    <div class="col-12 animated fadeIn">
        <div class="block block-rounded bg-light">
            <div class="block-content">
                <table class="table table-borderless">
                    <thead>
                    <tr>
                        <td class="d-none d-sm-table-cell text-center" style="width: 140px;">
                            <div class="mb-10">
                                <img class="img-avatar" src="{{ Storage::url($data_donasi_uang->foto_users) }}" alt="">
                            </div>
                        </td>
                        <td>
                            <p>
                                <strong>
                                    {{ $data_donasi_uang->nama_users }}
                                </strong>
                            </p>
                            <p>
                                Rp. {{ number_format($data_donasi_uang->saldo_transaksi,0,'','.') }},-
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
