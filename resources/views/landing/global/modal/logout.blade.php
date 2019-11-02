<div class="modal fade" id="modal_logout" tabindex="-1" role="dialog" aria-labelledby="modal-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-danger">
                    <h3 class="block-title">Logout</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <h4>
                        Apa anda yakin keluar dari aplikasi ?
                    </h4>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tidak</button>
                <a href="{{ route('otentikasi.logout') }}" class="btn btn-alt-danger">
                    Ya, saya yakin <i class="fa fa-check"></i>
                </a>
            </div>
        </div>
    </div>
</div>
