@foreach($daftar_donasi_kebutuhan as $data_donasi_kebutuhan)
    <div class="col-12 animated fadeIn">
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
