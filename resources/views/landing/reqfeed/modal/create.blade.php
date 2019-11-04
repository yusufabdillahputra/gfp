<div class="modal fade" id="modal_create_feed" tabindex="-1" role="dialog" aria-labelledby="modal-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('reqfeed.post') }}" role="form" autocomplete="off">
            @csrf
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">Request Feed</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <input type="hidden" name="status_feed" value="1">
                        <input type="hidden" name="draft_feed" value="2">
                        <input type="hidden" name="created_by" value="{{ $created_by }}">
                        <div class="form-group">
                            <label class="col-12">Judul Feed</label>
                            <div class="col-md-12">
                                <input autofocus type="text" class="form-control" placeholder="Masukkan judul request feed anda" name="judul_feed" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-alt-success">
                        <i class="fa fa-check"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
