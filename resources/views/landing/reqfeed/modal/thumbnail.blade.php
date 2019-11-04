<div class="modal fade" id="modal_thumbnail_e_feed" tabindex="-1" role="dialog" aria-labelledby="modal-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" role="form" action="{{ route('reqfeed.form.img.thumbnail') }}">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-gd-aqua">
                        <h3 class="block-title">Set Thumbnail</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        @method('PUT')
                        @csrf
                        <input type="hidden" id="t_id_img_feed" name="id_img_feed" required>
                        <input type="hidden" id="t_id_feed" name="id_feed" required>
                        <input type="hidden" id="t_updated_by" name="updated_by" required>
                        <div class="row">
                            <div class="col-12">
                                <div id="t_path_img_feed"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-alt-primary">
                        <i class="fa fa-check"></i> Ya, saya yakin
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
