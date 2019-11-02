<div class="modal fade" id="modal_auto_donasi" tabindex="-1" role="dialog" aria-labelledby="modal-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{ route('landing.donasi.auto') }}" autocomplete="off" role="form">
            @csrf
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">Auto Donasi</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <input type="hidden" name="id_users" value="{{ $session['id_users'] }}">
                        <input type="hidden" name="saldo_dompet" value="{{ $composers_saldo_dompet }}">
                        <input type="hidden" name="id_dompet" value="{{ $composers_id_dompet }}">
                        <h4>
                            Anda yakin untuk donasi uang otomatis ?
                        </h4>
                        <p class="text-warning">
                            <i class="si si-exclamation"></i> Semua saldo aktif anda akan dikurangi dan otomatis akan masuk ketiap tiap-tiap daftar donasi
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-alt-primary">Ya, saya yakin</button>
                </div>
            </div>
        </form>
    </div>
</div>
