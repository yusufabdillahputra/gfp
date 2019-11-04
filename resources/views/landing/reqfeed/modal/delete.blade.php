<div class="modal fade" id="modal_delete_e_feed" tabindex="-1" role="dialog" aria-labelledby="modal-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" role="form" action="{{ route('reqfeed.form.img.delete') }}">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-danger">
                        <h3 class="block-title">Hapus Gambar</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" id="d_id_img_feed" name="id_img_feed" required>
                        <div class="row">
                            <div class="col-12">
                                <div id="d_path_img_feed"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-alt-danger">
                        <i class="fa fa-check"></i> Ya, saya yakin
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
